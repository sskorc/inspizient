<?php

namespace Modules\TheatricalPerformance\Infrastructure\Persistence\InMemory;

use Modules\TheatricalPerformance\Domain\Demand;
use Modules\TheatricalPerformance\Domain\DemandRepository;

class InMemoryDemandRepository implements DemandRepository
{
    private $demands;

    public function __construct()
    {
        $this->demands = [];
    }

    public function add(Demand $demand)
    {
        $this->demands[] = $demand;
    }
}
