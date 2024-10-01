<?php

namespace App\Controller;

use App\Entity\CountryInfo; // Importando a entidade
use Doctrine\ORM\EntityManagerInterface; // Para gerenciar a persistência
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CountryInfoController extends AbstractController{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/CountryInfo/CapitalCity', name: 'CapitalCity_request')]
    public function soapRequest(Request $request): Response {
    $capitalCity = null;
    $countryName = null;

    $countries = [
        'US' => 'Estados Unidos',
        'BR' => 'Brasil',
        'DE' => 'Alemanha',
        'FR' => 'França',
        'IT' => 'Itália',
        'JP' => 'Japão',
        'CN' => 'China',
        'IN' => 'Índia',
        'RU' => 'Rússia',
        'ZA' => 'África do Sul',
    ];

       // Buscar todos os países cadastrados no banco de dados
       $repository = $this->entityManager->getRepository(CountryInfo::class);
       $countryList = $repository->findAll();

    // Verifica se foi enviado um código ISO
    if ($request->query->has('country_code')){
        $countryCode = $request->query->get('country_code');

        // URL do WSDL do serviço SOAP
        $wsdl = 'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?wsdl';

        try{
            // Criação do cliente SOAP
            $client = new \SoapClient($wsdl, [
                'trace' => 1,
                'exceptions' => true,
            ]);

            // Chamando o método do serviço (CapitalCity) e passando o parâmetro
            $params = ['sCountryISOCode' => $countryCode];
            $response = $client->__soapCall('CapitalCity', [$params]);
            $capitalCity = $response->CapitalCityResult;

            // Chamando o método (CountryName) e passando o parâmetro para obter o nome do país
            $countryNameResponse = $client->__soapCall('CountryName', [$params]);
            $countryName = $countryNameResponse->CountryNameResult;

            // Aqui, apenas pesquisamos, não inserimos nada
     
            }catch(\SoapFault $fault){
            // Tratamento de erros SOAP
            return new Response('Erro SOAP: ' . $fault->getMessage());
            }catch(\Exception $e){
            // Tratamento de outros erros
            return new Response('Erro: ' . $e->getMessage());
        }
    }

    // Renderiza o formulário e a capital
    return $this->render('soap/capital_city.html.twig', [
        'capitalCity' => $capitalCity,
        'countryName' => $countryName,
        'countries' => $countries,
        'countryList' => $countryList // Passando a lista de países
        ]);
    }
}