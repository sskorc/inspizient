<?php

namespace Modules\TheatricalPerformance\Infrastructure\Persistence\Doctrine;

use Modules\TheatricalPerformance\Domain\Demand;
use Modules\TheatricalPerformance\Domain\DemandRepository;

class DoctrineDemandRepository extends AbstractDoctrineRepository implements DemandRepository
{
    public function add(Demand $demand)
    {
        $this->manager->persist($demand);

        $this->manager->flush();
    }
}
