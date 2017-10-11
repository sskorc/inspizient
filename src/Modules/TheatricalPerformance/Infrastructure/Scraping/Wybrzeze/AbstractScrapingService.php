<?php

namespace Modules\TheatricalPerformance\Infrastructure\Scraping\Wybrzeze;

use Goutte\Client;

abstract class AbstractScrapingService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
