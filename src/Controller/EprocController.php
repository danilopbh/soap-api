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
                'uri' => 'http://www.cnj.jus.br/servico-intercomunicacao-2.2.2/',
            ]));

            // Construindo a requisição XML
            $xmlRequest = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://www.cnj.jus.br/servico-intercomunicacao-2.2.2/" xmlns:tip="http://www.cnj.jus.br/tipos-servico-intercomunicacao-2.2.2/">
                <soapenv:Header/>
                <soapenv:Body>
                    <ser:consultarProcesso>
                        <tip:idConsultante>18715383000140</tip:idConsultante>
                        <tip:senhaConsultante>9d818354c16ce308b6d4a316bbc71d0ed782bad0cfc518168f4aaa414a52048e</tip:senhaConsultante>
                        <tip:numeroProcesso>10035746520248130024</tip:numeroProcesso>
                        <tip:dataReferencia>20241001093800</tip:dataReferencia>
                        <tip:movimentos>true</tip:movimentos>
                        <tip:incluirCabecalho>true</tip:incluirCabecalho>
                        <tip:incluirDocumentos>true</tip:incluirDocumentos>
                        <tip:documento>11727714103161426873969223318</tip:documento>
                    </ser:consultarProcesso>
                </soapenv:Body>
            </soapenv:Envelope>');

            // Enviando a requisição
            $response = $client->__doRequest($xmlRequest->asXML(), 'https://eproc1g-hml.tjmg.jus.br/eproc/ws/controlador_ws.php?srv=intercomunicacao2.2', 'consultarProcesso', SOAP_1_1);

            // Imprimindo a resposta para depuração
            echo "Resposta XML:\n" . htmlspecialchars($response) . "\n";

            // Processar a resposta
            $responseXml = new SimpleXMLElement($response);
            
            //Exibindo os dados em uma resposta
            return new Response($responseXml);
        } catch (\SoapFault $fault) {
            return new Response('Erro SOAP: ' . $fault->getMessage());
        }
    }
}