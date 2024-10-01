<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiatuController extends AbstractController
{
    #[Route('/siatu', name: 'siatu_request')]
    public function soapRequest(): Response {
        // URL do WSDL do serviço SOAP
        $wsdl = 'http://siatuws.siatu-hm.pbh.gov.br/SiatuWS/api/v2/executaServico?wsdl';
        var_dump(ini_get('allow_url_fopen'));

        try {
            // Criação do cliente SOAP
            $client = new \SoapClient($wsdl, [
                'trace' => 1,    // Para debug, mantém as requisições no cliente
                'exceptions' => true,
            ]);

            // Chamando o método do serviço (execute_servico) e passando o parâmetro
            $params = [
                'usuario' => 'usrwsaj',
                'senha' => 'sajpbh',
                'codigo_convenio' => 'SIATU',
                'codigo_servico' => 'TESTEACESSO',
                'entrada' => 'teste de acesso ao SiatuWS'
            ];
            $response = $client->__soapCall('execute_servico', [$params]);

            var_dump($response);


            // Verifica se a resposta contém a validação do usuário e senha
            if (isset($response->validacao) && $response->validacao === true &&
                $params['usuario'] === 'usrwsaj' && $params['senha'] === 'sajpbh') {
                return new Response('Validação do usuário e senha bem-sucedida');
            } else {
                return new Response('Validação do usuário e senha sem sucesso');
            }
        } catch (\SoapFault $fault) {
            // Tratamento de erros SOAP
            return new Response('Erro SOAP: ' . $fault->getMessage() . ' Code: ' . $fault->getCode());
        }
    }
}