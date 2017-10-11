<?php

namespace Modules\TheatricalPerformance\Infrastructure\Scraping\Wybrzeze;

use Modules\TheatricalPerformance\Domain\NoMatchingPerformanceFoundException;
use Modules\TheatricalPerformance\Domain\Performance;
use Modules\TheatricalPerformance\Domain\PerformanceScrapingService;
use Symfony\Component\DomCrawler\Crawler;

class WybrzezePerformanceScrapingService extends AbstractScrapingService implements PerformanceScrapingService
{
    public function scrap(string $url, \DateTime $date): Performance
    {
        $title = 'unknown';
        $stage = 'unknown';

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

            preg_match('/^([0-9]{4}-[0-9]{2}-[0-9]{2})(.*)([0-9]{2}:[0-9]{2})$/', $performanceDateString, $matches);
            $performanceDate = $matches[1];
            $performanceTime = $matches[3];

            if (strcmp($performanceDate, $date->format('Y-m-d')) !== 0) {
                continue;
            }

            $dateTime = new \DateTime($performanceDate . ' ' . $performanceTime);

            $numberOfTicketsString = $performanceDetailsNode->filter('span.termin_wolne')->first()->text();
            $numberOfTickets = (int) str_replace('Liczba wolnych miejsc: ', '', $numberOfTicketsString);

            return new Performance($title, $stage, $dateTime, $numberOfTickets);
        }

        throw new NoMatchingPerformanceFoundException();
    }
}
