<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class XmlController extends AbstractController
{
    #[Route('/xml/process', name: 'process_xml')]
    public function processXml(): Response
    {
        // Caminho para o arquivo XML
        $filePath = $this->getParameter('kernel.project_dir') . '/public/xml/XML CDA 20950334375033.xml';

        if (!file_exists($filePath)) {
            return new Response('Arquivo XML não encontrado.');
        }

        // Carregar o XML
        $xml = simplexml_load_file($filePath);

        if ($xml === false) {
            return new Response('Erro ao carregar o arquivo XML.');
        }

        /*Exibir os dados do XML
        $output = '<h2>Informações da CDA</h2>';
        $output .= '<p>Tipo de evento: ' . $xml->MessageBody->CDA->tpevento . '</p>';
        $output .= '<p>Identificador da CDA: ' . $xml->MessageBody->CDA->idcda . '</p>';
        $output .= '<p>Contribuinte: ' . $xml->MessageBody->CDA->contribuinte->nome . '</p>';
        $output .= '<p>CPF/CNPJ: ' . $xml->MessageBody->CDA->contribuinte->cpf_cnpj . '</p>';
        $output .= '<p>Endereço: ' . $xml->MessageBody->CDA->contribuinte->endereco . '</p>';
        $output .= '<p>Endereço Correspondencia: ' . $xml->MessageBody->CDA->contribuinte->endereco_correspondencia . '</p>';
        $output .= '<p>BM / Gerente: ' . $xml->MessageBody->CDA->gerente_bm. ' - '. $xml->MessageBody->CDA->gerente_nome .'</p>';
        */
         
        //Exibir os dados do XML em uma tabela
        $output = '<h2>Informações da CDA</h2>';
        $output .= '<table border="1">';
        $output .= '<tr><th>Campo</th><th>Valor</th></tr>';
        
        foreach($xml->MessageBody->CDA->contribuinte as $key => $value){
            if (is_object($value)){
                foreach ($value as $subKey => $subValue){
                    $output .= '<tr><td>' . htmlspecialchars($subKey) . '</td><td>' . htmlspecialchars($subValue) . '</td></tr>';
                }
            }else{
                $output .= '<tr><td>' . htmlspecialchars($key) . '</td><td>' . htmlspecialchars($value) . '</td></tr>';
            }
        }

        foreach ($xml->MessageBody->CDA->contribuinte->lista_corresponsavel->corresponsavel as $corresponsavel){
            $output .=  $corresponsavel->nome_corresponsavel.'<br>';
            $output .=  $corresponsavel->endereco_corresponsavel.'<br>';
            $output .=  $corresponsavel->tipo_Logradouro_corresponsavel.'<br>';
            $output .=  $corresponsavel->Municipio_corresponsavel.'<br>';
        }

        /* Iterar sobre os elementos do XML
        foreach ($xml->MessageBody->CDA as $key => $value){
        // Se for um objeto, iterar sobre suas propriedades
            if (is_object($value)){
                foreach ($value as $subKey => $subValue){
                    $output .= '<tr><td>' . htmlspecialchars($subKey) . '</td><td>' . htmlspecialchars($subValue) . '</td></tr>';
                }
            }else{
                $output .= '<tr><td>' . htmlspecialchars($key) . '</td><td>' . htmlspecialchars($value) . '</td></tr>';
            }
        }*/

        /*  
            // Usando a recursividade para exibir todos os valores das tags de forma organizada 
            // Função para exibir dados em tabela
            $output = '<h2>Informações da CDA</h2>';
            $output .= '<table border="1" cellpadding="5" cellspacing="0">';
            $output .= '<tr><th>Tag</th><th>Valor</th></tr>';
    
            // Função recursiva para exibir tags e subtags
            $this->displayTags($xml->MessageBody->CDA, $output);
    
            $output .= '</table>';
    
            return new Response($output);
        }
    
        private function displayTags($element, &$output)
        {
            foreach ($element as $tag => $value) {
                if (is_object($value) && count($value) > 0) {
                    // Se a tag tem subtags, exibe a tag e chama a função recursivamente
                    $output .= '<tr><td>' . $tag . '</td><td>';
                    $output .= '<table border="1" cellpadding="5" cellspacing="0">';
                    $output .= '<tr><th>Subtag</th><th>Valor</th></tr>';
                    $this->displayTags($value, $output);
                    $output .= '</table>';
                    $output .= '</td></tr>';
                } else {
                    // Se a tag não tem subtags, exibe seu valor
                    $output .= '<tr><td>' . $tag . '</td><td>' . $value . '</td></tr>';
                }
            }
        */


        $output .= '</table>';
        

        // Processar mais dados conforme necessário
        return new Response($output);
    }
}