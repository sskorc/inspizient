<?php

namespace Modules\TheatricalPerformance\Infrastructure\Scraping\Wybrzeze;

use Modules\TheatricalPerformance\Domain\Performance;
use Modules\TheatricalPerformance\Domain\PerformanceScrapingService;
use Symfony\Component\DomCrawler\Crawler;

class WybrzezePerformanceScrapingService extends AbstractScrapingService implements PerformanceScrapingService
{
    public function scrap(string $url): array
    {
        $title = 'unknown';
        $stage = 'unknown';

        $performances = [];

        $crawler = $this->client->request('GET', $url);

        $content = $crawler->filter("#block-content");

        foreach ($content->getNode(0)->childNodes as $node) {
            if ($node->nodeName === '#text') {
                if (strpos($node->nodeValue, 'Spektakl:') !== false) {
                    $title = str_replace('Spektakl: ', '', $node->nodeValue);
                } elseif (strpos($node->nodeValue, 'Scena:') !== false) {
                    $stage = str_replace('Scena: ', '', $node->nodeValue);
                }
            }
        }

        $performanceListNode = $crawler->filter('table.lista_terminow')->first();
        $performanceDetailsNodes = $performanceListNode->filter('tr');
        foreach ($performanceDetailsNodes as $performanceDetailsNode) {
            $performanceDetailsNode = new Crawler($performanceDetailsNode);
            $performanceDateString = $performanceDetailsNode->filter('span.termin_data')->first()->text();
            $numberOfTicketsString = $performanceDetailsNode->filter('span.termin_wolne')->first()->text();
            $numberOfTickets = (int) str_replace('Liczba wolnych miejsc: ', '', $numberOfTicketsString);

            $performances[] = new Performance($title, $stage, $performanceDateString, $numberOfTickets);
        }

        return $performances;
    }
}
