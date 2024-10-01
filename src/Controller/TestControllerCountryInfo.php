<?php
// src/Controller/TestController.php
namespace App\Controller;

use App\Entity\CountryInfo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestControllerCountryInfo extends AbstractController
{
    #[Route('/test/insert', name: 'test_insert')]
    public function insert(EntityManagerInterface $entityManager): Response
    {
        $countryInfo = new CountryInfo();
        $countryInfo->setCountryCode('BR');
        $countryInfo->setCountryName('Brasil');
        $countryInfo->setCapitalCity('Brasília');

        $entityManager->persist($countryInfo);
        $entityManager->flush();

        return new Response('Dados inseridos com sucesso!');
    }

    #[Route('/test/read', name: 'test_read')]
    public function read(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(CountryInfo::class);
        $countries = $repository->findAll();

        $response = '<h1>Lista de Países</h1>';
        foreach ($countries as $country) {
            $response .= sprintf('<p>%s - %s (Capital: %s)</p>', $country->getCountryCode(), $country->getCountryName(), $country->getCapitalCity());
        }

        return new Response($response);
    }

    #[Route('/test/delete/{id}', name: 'test_delete')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $repository = $entityManager->getRepository(CountryInfo::class);
        $countryInfo = $repository->find($id);
    
        if (!$countryInfo) {
            return new Response('País não encontrado!');
        }
    
        $entityManager->remove($countryInfo);
        $entityManager->flush();

        $this->addFlash('success', 'País excluído com sucesso!');
            
        return $this->redirectToRoute('CapitalCity_request');
    }    

    #[Route('/country/update/{id}', name: 'country_update')]
    public function update(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(CountryInfo::class);
        $countryInfo = $repository->find($id);
    
        if (!$countryInfo) {
            throw $this->createNotFoundException('País não encontrado.');
        }
    
        // Obter dados do formulário
        $countryCode = $request->request->get('country_code');
        $countryName = $request->request->get('country_name');
        $capitalCity = $request->request->get('capital_city');
    
        // Atualizar os campos
        $countryInfo->setCountryCode($countryCode);
        $countryInfo->setCountryName($countryName);
        $countryInfo->setCapitalCity($capitalCity);
    
        // Persistir as mudanças
        $entityManager->flush();
    
        // Redirecionar de volta para a página principal com uma mensagem de sucesso
        $this->addFlash('success', 'Dados atualizados com sucesso!');
    
        return $this->redirectToRoute('CapitalCity_request');
    }    

    #[Route('/test/insert-form', name: 'test_insert_form')]
    public function insertForm(Request $request, EntityManagerInterface $entityManager): Response
    {
        $countryCode = $request->request->get('country_code');
        $countryName = $request->request->get('country_name');
        $capitalCity = $request->request->get('capital_city');

        if ($countryCode && $countryName && $capitalCity) {
            $repository = $entityManager->getRepository(CountryInfo::class);
            $existingCountry = $repository->findOneBy(['countryCode' => $countryCode]);

            // Verifica se o registro já existe
            if ($existingCountry) {
                return new Response('Registro já existe no banco de dados!');
            }

            // Criação do novo registro
            $countryInfo = new CountryInfo();
            $countryInfo->setCountryCode($countryCode);
            $countryInfo->setCountryName($countryName);
            $countryInfo->setCapitalCity($capitalCity);

            try {
                $entityManager->persist($countryInfo);
                $entityManager->flush();
    
                // Armazena uma mensagem de sucesso na sessão
                $this->addFlash('success', 'Dados inseridos com sucesso!');
    
                // Redireciona para a rota de pesquisa
                return $this->redirectToRoute('CapitalCity_request');
            } catch (\Exception $e) {
                return new Response('Erro ao inserir dados: ' . $e->getMessage());
            }
        }

        return new Response('Por favor, preencha todos os campos.');
     }
}