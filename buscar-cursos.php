#!/usr/bin/env php
<?php

use Aula\BuscadorDeCursos\Buscador;

require_once ('vendor/autoload.php');

//require_once 'src/BuscadorDeCursos.php';

use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
/* $client = new Client();
$url = "https://www.alura.com.br/cursos-online-programacao/php";

$resposta = $client->request('GET', $url);

$html = $resposta->getBody();


$status = $resposta->getStatusCode();

echo $status.PHP_EOL;

$crawler = new Crawler();
$crawler->addHtmlContent($html);
$cursos = $crawler->filter(selector:'span.card-curso__nome'); */

$client = new Client(['base_uri'=>'https://www.alura.com.br/']);
$crawler = new Crawler();
//$crawler->addHtmlContent($html);
$buscador = new Buscador($client, $crawler);

$cursos = $buscador->buscar(url:"/cursos-online-programacao/php");

foreach ($cursos as $key => $curso) {
    exibeMensagem($curso);
}
