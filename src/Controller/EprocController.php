<?php

namespace App\Controller;

use SimpleXMLElement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EprocController extends AbstractController
{
    #[Route('/eproc/consultarProcesso', name: 'consultarProcesso_request')]
    public function soapRequest(): Response {
        // Caminho para o arquivo XML local
        $xmlFilePath = $this->getParameter('kernel.project_dir') . '/PGM-soapui-project.xml';
    
        // Verifique se o arquivo existe
        if (!file_exists($xmlFilePath)) {
            return new Response('Arquivo XML não encontrado: ' . $xmlFilePath, Response::HTTP_NOT_FOUND);
        }
    
        // Carregue o conteúdo do XML
        $xmlContent = file_get_contents($xmlFilePath);
    
        // Configurações de SSL e outras opções
        $options = [
            'stream_context' => stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ]),
            'trace' => 1,
            'exceptions' => true,
        ];
    
        try {
            // Criação do cliente SOAP
            $client = new \SoapClient(null, array_merge($options, [
                'location' => 'https://eproc1g-hml.tjmg.jus.br/eproc/ws/controlador_ws.php?srv=intercomunicacao2.2',
                'uri' => 'http://www.cnj.jus.br/servico-intercomunicacao-2.2.2/', // Ajuste conforme necessário
            ]));
    
            // Parâmetros da chamada (baseados no XML)
            // Aqui você pode precisar manipular o XML para extrair os dados que você quer enviar
            $params = [
                'idConsultante' => '18715383000140',
                'senhaConsultante' => 'c2bc11b9315760e397f3068205186f4bae00aee103d80fe00fee79cf63a84782',
                'numeroProcesso' => '10035746520248130024',
                'dataReferencia' => '20240930170200',
                'movimentos' => true,
                'incluirCabecalho' => true,
                'incluirDocumentos' => true,
            ];
    
            // Você pode construir a requisição XML aqui se precisar
            $xmlRequest = new SimpleXMLElement($xmlContent);
            // Exemplo de como você poderia usar o SimpleXMLElement para construir a solicitação:
            // $xmlRequest->someElement = $params['idConsultante'];
            
            // Envie a requisição
            $response = $client->__soapCall('consultarProcesso', [$params]);
    
            // Exibindo a requisição e resposta para depuração
            echo "Request :\n" . $client->__getLastRequest() . "\n";
            echo "Response:\n" . $client->__getLastResponse() . "\n";
    
            // Exibindo a resposta
            return new Response('<pre>' . print_r($response, true) . '</pre>');
        } catch (\SoapFault $fault) {
            // Tratamento de erros SOAP
            return new Response('Erro SOAP: ' . $fault->getMessage());
        }
    }     
}