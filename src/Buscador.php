<?php

namespace Aula\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private ClientInterface $httpClient;
    private Crawler $crawler;
    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }
    public function buscar(string $url): array
    {
        try {
            $cursos = [];
            $reposta = $this->httpClient->request("GET", $url);

            $html = $reposta->getBody();
            $this->crawler->addHtmlContent($html);
            $elementosCursos = $this->crawler->filter(selector: 'span.card-curso__nome');

            foreach ($elementosCursos as $key => $elemento) {
                $cursos[] = $elemento->textContent;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            $cursos = [];
        }
        print_r($cursos);
        return $cursos;
    }
}
