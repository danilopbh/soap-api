<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SoapController extends AbstractController
{
    #[Route('/soap', name: 'soap_request')]
    public function soapRequest(): Response
    {
        // URL do WSDL do serviço SOAP
        $wsdl = 'https://www.dataaccess.com/webservicesserver/NumberConversion.wso?WSDL';
        
        try {
            // Criação do cliente SOAP
            $client = new \SoapClient($wsdl, [
                'trace' => 1,    // Para debug, mantém as requisições no cliente
                'exceptions' => true,
            ]);

            // Chamando o método do serviço (NumberToWords) e passando o parâmetro
            $params = ['ubiNum' => 123];
            $response = $client->__soapCall('NumberToWords', [$params]);

            // Exibindo a resposta
            return new Response('<pre>' . print_r($response, true) . '</pre>');
        } catch (\SoapFault $fault) {
            // Tratamento de erros SOAP
            return new Response('Erro SOAP: ' . $fault->getMessage());
        }
    }
}
