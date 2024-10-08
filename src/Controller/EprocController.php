<?php

namespace App\Controller;

use DateTime;
use SimpleXMLElement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EprocController extends AbstractController
{
    protected $senhaConsultante;

    public function __construct()
    {
        $this->senhaConsultante = '93875557dc4e27734eb632ddea19b8c61eb732ee2fa377d015ffb122a8866456';
    }

    #[Route('/eproc/consultarProcesso', name: 'consultarProcesso_request')]
    public function soapRequestProcesso(): Response
    {
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
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
                              xmlns:ser="http://www.cnj.jus.br/servico-intercomunicacao-2.2.2/" 
                              xmlns:tip="http://www.cnj.jus.br/tipos-servico-intercomunicacao-2.2.2/">
                <soapenv:Header/>
                <soapenv:Body>
                    <ser:consultarProcesso>
                        <tip:idConsultante>18715383000140</tip:idConsultante>
                        <tip:senhaConsultante>' . $this->senhaConsultante . '</tip:senhaConsultante>
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
            $responseXml = $client->__doRequest($xmlRequest->asXML(), 'https://eproc1g-hml.tjmg.jus.br/eproc/ws/controlador_ws.php?srv=intercomunicacao2.2', 'consultarProcesso', SOAP_1_1);

            // Carregando a resposta
            $response = simplexml_load_string($responseXml);

            if ($response === false) {
                // Exibindo erros de libxml
                foreach (libxml_get_errors() as $error) {
                    echo "\t", $error->message;
                }
            } else {
                // Acessando o corpo da resposta
                $body = $response->children('SOAP-ENV', true)->Body;
                $consultarProcessoResposta = $body->children('ns3', true)->consultarProcessoResposta;
                //echo "Resposta XML:\n" . htmlspecialchars($responseXml) . "\n";


                if ($consultarProcessoResposta) {
                    // Carregando a string XML
                    $xml = simplexml_load_string($responseXml);

                    // Acessando dados básicos
                    $dadosBasicos = $xml->xpath('//ns1:processo/ns2:dadosBasicos')[0] ?? null;
                    $polo = $xml->xpath('//ns1:processo/ns2:dadosBasicos/ns2:polo')[0] ?? null;
                    $polo2 = $xml->xpath('//ns1:processo/ns2:dadosBasicos/ns2:polo[@polo="PA"]')[0] ?? null;
                    $parte = $polo ? $polo->xpath('ns2:parte')[0] ?? null : null;
                    $parte2 = $polo2 ? $polo2->xpath('ns2:parte')[0] ?? null : null;
                    $pessoa = $parte ? $parte->xpath('ns2:pessoa')[0] ?? null : null;
                    $pessoa2 = $parte2 ? $parte2->xpath('ns2:pessoa')[0] ?? null : null;
                    $documento = $pessoa ? $pessoa->xpath('ns2:documento')[0] ?? null : null;
                    $documento2 = $pessoa2 ? $pessoa2->xpath('ns2:documento')[0] ?? null : null;
                    $advogado = $parte2 ? $parte2->xpath('ns2:advogado')[0] ?? null : null;
                    $endereco = $advogado ? $advogado->xpath('ns2:endereco')[0] ?? null : null;
                    $assunto = $xml->xpath('//ns1:processo/ns2:dadosBasicos/ns2:assunto')[0] ?? null;
                    $magistradoAtuante = $xml->xpath('//ns1:processo/ns2:dadosBasicos/ns2:magistradoAtuante')[0] ?? null;
                    $valorCausa = $xml->xpath('//ns1:processo/ns2:dadosBasicos/ns2:valorCausa')[0] ?? null;
                    $orgaoJulgador = $xml->xpath('//ns1:processo/ns2:dadosBasicos/ns2:orgaoJulgador')[0] ?? null;

                    if (
                        $dadosBasicos || $polo || $parte || $pessoa || $documento ||
                        $polo2 || $parte2 || $pessoa2 || $documento2 || $advogado ||
                        $endereco || $assunto || $magistradoAtuante || $valorCausa ||
                        $orgaoJulgador
                    ) {

                        // Extraindo atributos
                        $numero = (string)$dadosBasicos['numero'] ?? '';
                        $competencia = (string)$dadosBasicos['competencia'] ?? '';
                        $classeProcessual = (string)$dadosBasicos['classeProcessual'] ?? '';
                        $codigoLocalidade = (string)$dadosBasicos['codigoLocalidade'] ?? '';
                        $nivelSigilo = (string)$dadosBasicos['nivelSigilo'] ?? '';
                        $intervencaoMP = (string)$dadosBasicos['intervencaoMP'] ?? '';
                        $tamanhoProcesso = (string)$dadosBasicos['tamanhoProcesso'] ?? '';
                        $dataAjuizamento = (string)$dadosBasicos['dataAjuizamento'] ?? '';
                        $poloNome = $polo ? (string)$polo['polo'] ?? '' : '';
                        $assistenciaJudiciaria = $parte ? (string)$parte['assistenciaJudiciaria'] ?? '' : '';
                        $nome = $pessoa ? (string)$pessoa['nome'] ?? '' : '';
                        $sexo = $pessoa ? (string)$pessoa['sexo'] ?? '' : '';
                        $numeroDocumentoPrincipal = $pessoa ? (string)$pessoa['numeroDocumentoPrincipal'] ?? '' : '';
                        $tipoPessoa = $pessoa ? (string)$pessoa['tipoPessoa'] ?? '' : '';
                        $codigoDocumento = $documento ? (string)$documento['codigoDocumento'] ?? '' : '';
                        $emissorDocumento = $documento ? (string)$documento['emissorDocumento'] ?? '' : '';
                        $tipoDocumento = $documento ? (string)$documento['tipoDocumento'] ?? '' : '';

                        // Polo 2
                        $polo2Nome = $polo2 ? (string)$polo2['polo'] ?? '' : '';
                        $assistenciaJudiciaria2 = $parte2 ? (string)$parte2['assistenciaJudiciaria'] ?? '' : '';
                        $nome2 = $pessoa2 ? (string)$pessoa2['nome'] ?? '' : '';
                        $sexo2 = $pessoa2 ? (string)$pessoa2['sexo'] ?? '' : '';
                        $numeroDocumentoPrincipal2 = $pessoa2 ? (string)$pessoa2['numeroDocumentoPrincipal'] ?? '' : '';
                        $tipoPessoa2 = $pessoa2 ? (string)$pessoa2['tipoPessoa'] ?? '' : '';
                        $codigoDocumento2 = $documento2 ? (string)$documento2['codigoDocumento'] ?? '' : '';
                        $emissorDocumento2 = $documento2 ? (string)$documento2['emissorDocumento'] ?? '' : '';
                        $tipoDocumento2 = $documento2 ? (string)$documento2['tipoDocumento'] ?? '' : '';

                        // Advogado
                        $nomeAdvogado = $advogado ? (string)$advogado['nome'] ?? '' : '';
                        $numeroDocumentoPrincipalAdvogado = $advogado ? (string)$advogado['numeroDocumentoPrincipal'] ?? '' : '';
                        $intimacao = $advogado ? (string)$advogado['intimacao'] ?? '' : '';
                        $tipoRepresentante = $advogado ? (string)$advogado['tipoRepresentante'] ?? '' : '';

                        // Endereço
                        if ($endereco) {
                            $cep = (string)$endereco['cep'] ?? '';
                            $logradouro = (string)$endereco->children('http://www.cnj.jus.br/intercomunicacao-2.2.2')->logradouro ?? '';
                            $numeroEndereco = (string)$endereco->children('http://www.cnj.jus.br/intercomunicacao-2.2.2')->numero ?? '';
                            $complemento = (string)$endereco->children('http://www.cnj.jus.br/intercomunicacao-2.2.2')->complemento ?? '';
                            $bairro = (string)$endereco->children('http://www.cnj.jus.br/intercomunicacao-2.2.2')->bairro ?? '';
                            $cidade = (string)$endereco->children('http://www.cnj.jus.br/intercomunicacao-2.2.2')->cidade ?? '';
                            $estado = (string)$endereco->children('http://www.cnj.jus.br/intercomunicacao-2.2.2')->estado ?? '';
                            $pais = (string)$endereco->children('http://www.cnj.jus.br/intercomunicacao-2.2.2')->pais ?? '';
                        }

                        // Assunto
                        $principal = (string)$assunto['principal'] ?? '';
                        $codigoNacional = $assunto ? (string)$assunto->children('http://www.cnj.jus.br/intercomunicacao-2.2.2')->codigoNacional ?? '' : '';

                        // Magistrado atuante
                        $codigoMagistradoAtuante = (string)$magistradoAtuante ?? '';
                        $valorDaCausa = (string)$valorCausa ?? '';

                        // Órgão julgador
                        if ($orgaoJulgador) {
                            $codigoOrgao = (string)$orgaoJulgador['codigoOrgao'] ?? '';
                            $nomeOrgao = (string)$orgaoJulgador['nomeOrgao'] ?? '';
                            $instancia = (string)$orgaoJulgador['instancia'] ?? '';
                            $codigoMunicipioIBGE = (string)$orgaoJulgador['codigoMunicipioIBGE'] ?? '';
                        }

                        // Exibindo dados em uma tabela HTML
                        echo '<h2>Dados do processo</h2>';
                        echo '<table border="1">';
                        echo '<tr><th>Atributo</th><th>Valor</th></tr>';
                        echo "<tr><td>Número</td><td>$numero</td></tr>";
                        echo "<tr><td>Competência</td><td>$competencia</td></tr>";
                        echo "<tr><td>Classe Processual</td><td>$classeProcessual</td></tr>";
                        echo "<tr><td>Código Localidade</td><td>$codigoLocalidade</td></tr>";
                        echo "<tr><td>Nível Sigilo</td><td>$nivelSigilo</td></tr>";
                        echo "<tr><td>Intervenção MP</td><td>$intervencaoMP</td></tr>";
                        echo "<tr><td>Tamanho Processo</td><td>$tamanhoProcesso</td></tr>";
                        echo "<tr><td>Data Ajuizamento</td><td>$dataAjuizamento</td></tr>";
                        echo "<tr><td>Polo</td><td>$poloNome</td></tr>";
                        echo "<tr><td>Assistência Judiciária</td><td>$assistenciaJudiciaria</td></tr>";
                        echo "<tr><td>Nome</td><td>$nome</td></tr>";
                        echo "<tr><td>Sexo</td><td>$sexo</td></tr>";
                        echo "<tr><td>Número Documento Principal</td><td>$numeroDocumentoPrincipal</td></tr>";
                        echo "<tr><td>Tipo Pessoa</td><td>$tipoPessoa</td></tr>";
                        echo "<tr><td>Código Documento</td><td>$codigoDocumento</td></tr>";
                        echo "<tr><td>Emissor Documento</td><td>$emissorDocumento</td></tr>";
                        echo "<tr><td>Tipo Documento</td><td>$tipoDocumento</td></tr>";

                        // Polo 2
                        echo "<tr><td>Polo 2</td><td>$polo2Nome</td></tr>";
                        echo "<tr><td>Assistência Judiciária 2</td><td>$assistenciaJudiciaria2</td></tr>";
                        echo "<tr><td>Nome 2</td><td>$nome2</td></tr>";
                        echo "<tr><td>Sexo 2</td><td>$sexo2</td></tr>";
                        echo "<tr><td>Número Documento Principal 2</td><td>$numeroDocumentoPrincipal2</td></tr>";
                        echo "<tr><td>Tipo Pessoa 2</td><td>$tipoPessoa2</td></tr>";
                        echo "<tr><td>Código Documento 2</td><td>$codigoDocumento2</td></tr>";
                        echo "<tr><td>Emissor Documento 2</td><td>$emissorDocumento2</td></tr>";
                        echo "<tr><td>Tipo Documento 2</td><td>$tipoDocumento2</td></tr>";

                        // Advogado
                        echo "<tr><td>Nome Advogado</td><td>$nomeAdvogado</td></tr>";
                        echo "<tr><td>Número Documento Principal Advogado</td><td>$numeroDocumentoPrincipalAdvogado</td></tr>";
                        echo "<tr><td>Intimação</td><td>$intimacao</td></tr>";
                        echo "<tr><td>Tipo Representante</td><td>$tipoRepresentante</td></tr>";

                        // Endereço
                        echo "<tr><td>CEP</td><td>$cep</td></tr>";
                        echo "<tr><td>Logradouro</td><td>$logradouro</td></tr>";
                        echo "<tr><td>Número</td><td>$numeroEndereco</td></tr>";
                        echo "<tr><td>Complemento</td><td>$complemento</td></tr>";
                        echo "<tr><td>Bairro</td><td>$bairro</td></tr>";
                        echo "<tr><td>Cidade</td><td>$cidade</td></tr>";
                        echo "<tr><td>Estado</td><td>$estado</td></tr>";
                        echo "<tr><td>País</td><td>$pais</td></tr>";

                        // Assunto
                        echo "<tr><td>Assunto</td><td>$principal</td></tr>";
                        echo "<tr><td>Código Nacional</td><td>$codigoNacional</td></tr>";

                        // Magistrado atuante
                        echo "<tr><td>Magistrado Atuante</td><td>$codigoMagistradoAtuante</td></tr>";

                        // Outros parâmetros
                        foreach ($xml->xpath('//ns1:processo/ns2:dadosBasicos/ns2:outroParametro') as $parametro) {
                            $nomeParam = (string)$parametro['nome'] ?? '';
                            $valorParam = (string)$parametro['valor'] ?? '';
                            echo "<tr><td>$nomeParam</td><td>" . (!empty($valorParam) ? $valorParam : 'Não contém valor') . "</td></tr>";
                        }

                        // Valor da causa
                        echo "<tr><td>Valor da Causa</td><td>$valorDaCausa</td></tr>";

                        // Órgão julgador
                        echo "<tr><td>Código Órgão</td><td>$codigoOrgao</td></tr>";
                        echo "<tr><td>Nome Órgão</td><td>$nomeOrgao</td></tr>";
                        echo "<tr><td>Instância</td><td>$instancia</td></tr>";
                        echo "<tr><td>Código Município IBGE</td><td>$codigoMunicipioIBGE</td></tr>";
                        echo '</table>';
                    } else {
                        echo "Dados básicos não encontrados.\n";
                    }
                }
            }

            // Exibindo os dados em uma resposta
            return new Response($dadosBasicos);
        } catch (\SoapFault $fault) {
            return new Response('Erro SOAP: ' . $fault->getMessage());
        }
    }

    #[Route('/eproc/consultarAlteracao', name: 'consultarAlteracao_request')]
    public function soapRequestAlteracao(): Response
    {
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
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
                              xmlns:ser="http://www.cnj.jus.br/servico-intercomunicacao-2.2.2/" 
                              xmlns:tip="http://www.cnj.jus.br/tipos-servico-intercomunicacao-2.2.2/">
                <soapenv:Header/>
                <soapenv:Body>
                    <ser:consultarAlteracao>
                        <tip:idConsultante>18715383000140</tip:idConsultante>
                        <tip:senhaConsultante>' . $this->senhaConsultante . '</tip:senhaConsultante>
                        <tip:numeroProcesso>10035746520248130024</tip:numeroProcesso>
                    </ser:consultarAlteracao>
                </soapenv:Body>
            </soapenv:Envelope>');

            // Enviando a requisição
            $responseXml = $client->__doRequest($xmlRequest->asXML(), 'https://eproc1g-hml.tjmg.jus.br/eproc/ws/controlador_ws.php?srv=intercomunicacao2.2', 'consultarAlteracao', SOAP_1_1);

            // Carregando a resposta XML
            $response = simplexml_load_string($responseXml);
            if ($response === false) {
                foreach (libxml_get_errors() as $error) {
                    echo "\t", $error->message;
                }
                return new Response('Erro ao carregar a resposta SOAP');
            }

            // Verificando a resposta e acessando o corpo
            $body = $response->children('SOAP-ENV', true)->Body;
            $consultarAlteracaoResposta = $body->children('ns2', true)->consultarAlteracaoResposta;

            if ($consultarAlteracaoResposta) {
                $hashCabecalho = $consultarAlteracaoResposta->children('ns1', true)->hashCabecalho;
                $hashMovimentacoes = $consultarAlteracaoResposta->children('ns1', true)->hashMovimentacoes;
                $hashDocumentos = $consultarAlteracaoResposta->children('ns1', true)->hashDocumentos;

                // Retornando os valores
                return new Response(
                    '<h2>Alterações no processo</h2>' .
                        '<table border="1">' .
                        '<tr><th>Atributo</th><th>Valor</th></tr>' .
                        '<tr><td>Hash Cabeçalho</td><td>' . (string)$hashCabecalho . '</td></tr>' .
                        '<tr><td>Hash Movimentações</td><td>' . (string)$hashMovimentacoes . '</td></tr>' .
                        '<tr><td>Hash Documentos</td><td>' . (string)$hashDocumentos . '</td></tr>' .
                        '</table>'
                );
            } else {
                return new Response('Nenhuma alteração encontrada no processo.');
            }
        } catch (\SoapFault $fault) {
            // Tratamento de erro SOAP
            return new Response('Erro SOAP: ' . $fault->getMessage());
        }
    }

    #[Route('/eproc/consultarAvisosPendentes', name: 'consultarAvisosPendentes_request')]
    public function soapRequestAvisosPendentes(): Response
    {
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
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
                              xmlns:ser="http://www.cnj.jus.br/servico-intercomunicacao-2.2.2/" 
                              xmlns:tip="http://www.cnj.jus.br/tipos-servico-intercomunicacao-2.2.2/">
                <soapenv:Header/>
                <soapenv:Body>
                    <ser:consultarAvisosPendentes>
                        <tip:idConsultante>18715383000140</tip:idConsultante>
                        <tip:senhaConsultante>' . $this->senhaConsultante . '</tip:senhaConsultante>
                        <tip:dataReferencia>20241001093800</tip:dataReferencia>
                    </ser:consultarAvisosPendentes>
                </soapenv:Body>
            </soapenv:Envelope>');

            // Enviando a requisição
            $responseXml = $client->__doRequest($xmlRequest->asXML(), 'https://eproc1g-hml.tjmg.jus.br/eproc/ws/controlador_ws.php?srv=intercomunicacao2.2', 'consultarAvisosPendentes', SOAP_1_1);

            // Carregando a resposta XML
            $response = simplexml_load_string($responseXml);
            if ($response === false) {
                foreach (libxml_get_errors() as $error) {
                    echo "\t", $error->message;
                }
                return new Response('Erro ao carregar a resposta SOAP');
            }

            // Verificando a resposta e acessando o corpo
            $body = $response->children('SOAP-ENV', true)->Body;
            $consultarAvisosPendentesResposta = $body->children('ns3', true)->consultarAvisosPendentesResposta;
            $aviso = $body->xpath('//ns1:aviso')[0] ?? null;
            $pessoa = $body->xpath('//ns1:aviso/ns2:destinatario/ns2:pessoa')[0] ?? null;
            $processo = $body->xpath('//ns2:processo')[0] ?? null;
            $orgaoJulgador = $body->xpath('//ns1:aviso/ns2:processo/ns2:orgaoJulgador')[0] ?? null;

            if ($consultarAvisosPendentesResposta || $aviso || $pessoa || $processo || $orgaoJulgador) {
                $mensagem = $consultarAvisosPendentesResposta->children('ns1', true)->mensagem;

                // Remover as chaves e separar o conteúdo
                $mensagemLimpa = str_replace(['{', '}'], '', $mensagem);
                $partesMensagem = explode("'", $mensagemLimpa);

                if (isset($partesMensagem[3])) {
                    // Tenta criar o objeto DateTime
                    $dataAtualizacao = DateTime::createFromFormat('YmdHis', $partesMensagem[3]);

                    if ($dataAtualizacao !== false) {
                        // Se for válido, formata a data
                        $dataFormatada = $dataAtualizacao->format('d/m/Y H:i:s');
                        echo '<span style="color: green; font-weight: bold;"> Consulta realizada com sucesso - Atualizado em: ' . $dataFormatada . '</span>';
                    } else {
                        // Se a data não estiver no formato correto
                        echo 'Formato de data inválido.';
                    }
                } else {
                    echo 'Mensagem não contém a data de atualização.';
                }

                $idAviso = (string)$aviso['idAviso'] ?? '';
                $tipoComunicacao = (string)$aviso['tipoComunicacao'] ?? '';
                $nome = (string)$pessoa['nome'] ?? '';
                $numeroDocumentoPrincipal = (string)$pessoa['numeroDocumentoPrincipal'] ?? '';
                $tipoPessoa = (string)$pessoa['tipoPessoa'] ?? '';
                $numero = (string)$processo['numero'] ?? '';
                $competencia = (string)$processo['competencia'] ?? '';
                $classeProcessual = (string)$processo['classeProcessual'] ?? '';
                $nivelSigilo = (string)$processo['nivelSigilo'] ?? '';
                $intervencaoMP = (string)$processo['intervencaoMP'] ?? '';
                $tamanhoProcesso = (string)$processo['tamanhoProcesso'] ?? '';
                $dataAjuizamento = (string)$processo['dataAjuizamento'] ?? '';
                $codigoOrgao = (string)$orgaoJulgador['codigoOrgao'] ?? '';
                $nomeOrgao = (string)$orgaoJulgador['nomeOrgao'] ?? '';
                $instancia = (string)$orgaoJulgador['instancia'] ?? '';
                $codigoMunicipioIBGE = (string)$orgaoJulgador['codigoMunicipioIBGE'] ?? '';
                $dataDisponibilizacao = $aviso->children('ns2', true)->dataDisponibilizacao;

                echo '<h2>Avisos pendentes do processo</h2>';
                echo '<table border="1">';
                echo '<tr><th>Atributo</th><th>Valor</th></tr>';
                echo '<tr><td>idAviso</td><td>' . $idAviso . '</td></tr>';
                echo '<tr><td>tipoComunicação</td><td>' . $tipoComunicacao . '</td></tr>';
                echo '<tr><td>nome</td><td>' . $nome . '</td></tr>';
                echo '<tr><td>numeroDocumentoPrincipal</td><td>' . $numeroDocumentoPrincipal . '</td></tr>';
                echo '<tr><td>tipoPessoa</td><td>' . $tipoPessoa . '</td></tr>';
                echo '<tr><td>número do processo</td><td>' . $numero . '</td></tr>';
                echo '<tr><td>competência</td><td>' . $competencia . '</td></tr>';
                echo '<tr><td>classe processual</td><td>' . $classeProcessual . '</td></tr>';
                echo '<tr><td>nível de sigílo</td><td>' . $nivelSigilo . '</td></tr>';
                echo '<tr><td>intervenção do ministério público</td><td>' . $intervencaoMP . '</td></tr>';
                echo '<tr><td>tamanho do processo</td><td>' . $tamanhoProcesso . '</td></tr>';
                echo '<tr><td>data de ajuizamento</td><td>' . $dataAjuizamento . '</td></tr>';

                // Outros parâmetros
                foreach ($body->xpath('//ns1:aviso/ns2:processo/ns2:outroParametro') as $parametro) {
                    $nomeParam = (string)$parametro['nome'] ?? '';
                    $valorParam = (string)$parametro['valor'] ?? '';
                    echo "<tr><td>$nomeParam</td><td>" . (!empty($valorParam) ? $valorParam : 'Não contém valor') . "</td></tr>";
                }

                echo '<tr><td>código do orgão julgador</td><td>' . $codigoOrgao . '</td></tr>';
                echo '<tr><td>nome do orgão julgador</td><td>' . $nomeOrgao . '</td></tr>';
                echo '<tr><td>instância</td><td>' . $instancia . '</td></tr>';
                echo '<tr><td>código do municipio pelo IBGE</td><td>' . $codigoMunicipioIBGE . '</td></tr>';
                echo '<tr><td>Data da disponibilização</td><td>' . (string)$dataDisponibilizacao . '</td></tr>';
                echo '</table>';

                // Retornando os valores
                return new Response($consultarAvisosPendentesResposta);
            } else {
                return new Response('Não há avisos pendentes');
            }
        } catch (\SoapFault $fault) {
            // Tratamento de erro SOAP
            return new Response('Erro SOAP: ' . $fault->getMessage());
        }
    }

    #[Route('/eproc/consultarTeorComunicacao', name: 'consultarTeorComunicacao_request')]
    public function soapRequestTeorComunicacao(): Response
    {
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

        try{
            // Criação do cliente SOAP
            $client = new \SoapClient(null, array_merge($options, [
                'location' => 'https://eproc1g-hml.tjmg.jus.br/eproc/ws/controlador_ws.php?srv=intercomunicacao2.2',
                'uri' => 'http://www.cnj.jus.br/servico-intercomunicacao-2.2.2/',
            ]));

            // Construindo a requisição XML
            $xmlRequest = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
                              xmlns:ser="http://www.cnj.jus.br/servico-intercomunicacao-2.2.2/" 
                              xmlns:tip="http://www.cnj.jus.br/tipos-servico-intercomunicacao-2.2.2/">
                <soapenv:Header/>
                <soapenv:Body>
                    <ser:consultarTeorComunicacao>
                        <tip:idConsultante>18715383000140</tip:idConsultante>
                        <tip:senhaConsultante>' . $this->senhaConsultante . '</tip:senhaConsultante>
                        <tip:numeroProcesso>10035746520248130024</tip:numeroProcesso>
                        <tip:identificadorAviso>202410020000030</tip:identificadorAviso>
                    </ser:consultarTeorComunicacao>
                </soapenv:Body>
            </soapenv:Envelope>');

            // Enviando a requisição
            $responseXml = $client->__doRequest($xmlRequest->asXML(), 'https://eproc1g-hml.tjmg.jus.br/eproc/ws/controlador_ws.php?srv=intercomunicacao2.2', 'consultarTeorComunicacao', SOAP_1_1);

            // Carregando a resposta XML
            $response = simplexml_load_string($responseXml);
            if ($response === false) {
                foreach (libxml_get_errors() as $error) {
                    echo "\t", $error->message;
                }
                return new Response('Erro ao carregar a resposta SOAP');
            }

            // Verificando a resposta e acessando o corpo
            $body = $response->children('SOAP-ENV', true)->Body;
            $consultarTeorComunicacaoResposta = $body->children('ns3', true)->consultarTeorComunicacaoResposta;
            $comunicacao = $body->xpath('//ns1:comunicacao')[0] ?? null;
            $pessoa = $body->xpath('//ns2:destinatario/ns2:pessoa')[0] ?? null;
            $processo = $comunicacao->xpath('//ns2:processo')[0] ?? null;

            if ($consultarTeorComunicacaoResposta || $comunicacao || $pessoa || $processo) {
                $mensagem = $consultarTeorComunicacaoResposta->children('ns1', true)->mensagem;

                $id = (string)$comunicacao['id'] ?? '';
                $tipoComunicacao = (string)$comunicacao['tipoComunicacao'] ?? '';
                $dataReferencia = (string)$comunicacao['dataReferencia'] ?? '';
                $nivelSigilo = (string)$comunicacao['nivelSigilo'] ?? '';
                $nome = (string)$pessoa['nome'] ?? '';
                $numeroDocumentoPrincipal = (string)$pessoa['numeroDocumentoPrincipal'] ?? '';
                $tipoPessoa = (string)$pessoa['tipoPessoa'] ?? '';
                $numProcesso = (string)$processo ?? '';
               
                echo '<span style="color: green; font-weight: bold;">' . $mensagem . '</span>';
                echo '<h2>Teor de comunicação do processo</h2>';
                echo '<table border="1">';
                echo '<tr><th>Atributo</th><th>Valor</th></tr>';
                echo '<tr><td>id da comunicação</td><td>' . $id . '</td></tr>';
                echo '<tr><td>tipoComunicação</td><td>' . $tipoComunicacao . '</td></tr>';
                echo '<tr><td>dataReferencia</td><td>' . $dataReferencia . '</td></tr>';
                echo '<tr><td>nivelSigilo</td><td>' . $nivelSigilo . '</td></tr>';
                echo '<tr><td>nome</td><td>' . $nome . '</td></tr>';
                echo '<tr><td>numeroDocumentoPrincipal</td><td>' . $numeroDocumentoPrincipal . '</td></tr>';
                echo '<tr><td>tipoPessoa</td><td>' . $tipoPessoa . '</td></tr>';
                echo '<tr><td>numProcesso</td><td>' . $numProcesso . '</td></tr>';
                echo '</table>';

                // Retornando os valores
                return new Response($consultarTeorComunicacaoResposta);
            } else {
                return new Response('Não há teor de comunicação');
            }
        }catch(\SoapFault $fault) {
            // Tratamento de erro SOAP
            return new Response('Erro SOAP: ' . $fault->getMessage());
        }
    }
}