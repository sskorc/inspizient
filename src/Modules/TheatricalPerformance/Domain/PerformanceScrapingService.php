<?php

namespace Modules\TheatricalPerformance\Domain;

interface PerformanceScrapingService
{
    public function scrap(string $url): array;
}
