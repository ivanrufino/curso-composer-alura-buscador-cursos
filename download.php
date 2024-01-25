<?php
require_once ('vendor/autoload.php');
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
$client = new Client();

$url = "https://test-cedente-multibanco.cobexpress.com.br//webservice/downloader-retorno/";
$resposta = $client->request('POST', $url,
    [
        'form_params' => [
            "token" => ["6efbb806c0b4b7d8cdf791e61b552573", 1705943188, "ba603b5dd3ec3e99d898d75465ba8e97"],
            "data" => "2024-01-22 12:20:43",
            "action" => "obterListaArquivo"
        ]
    ]
);
/*
pra enviar arquivo
$resposta = $client->request('POST', $url, [
    'multipart' => [
        [
            'name' => 'arquivo', // Nome do campo do formulário
            'contents' => $fileStream,
            'filename' => 'arquivo.txt', // Nome do arquivo que será enviado
        ],
        [
            'name' => 'token',
            'contents' => json_encode(["6efbb806c0b4b7d8cdf791e61b552573", 1705943188, "ba603b5dd3ec3e99d898d75465ba8e97"]),
        ],
        [
            'name' => 'data',
            'contents' => '2024-01-22 12:20:43',
        ],
        [
            'name' => 'action',
            'contents' => 'obterListaArquivo',
        ],
    ],
]);
*/
$html = $resposta->getBody();
echo$html;die();

$status = $resposta->getStatusCode();

echo $status.PHP_EOL;

$crawler = new Crawler();
$crawler->addHtmlContent($html);
$cursos = $crawler->filter(selector:'span.card-curso__nome');
foreach ($cursos as $key => $curso) {
    echo $curso->textContent. PHP_EOL;
}
