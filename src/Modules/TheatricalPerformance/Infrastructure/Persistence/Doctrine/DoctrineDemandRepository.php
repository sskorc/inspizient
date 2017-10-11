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

    public function read(): array
    {
        return $this->manager->getRepository(Demand::class)->findBy([]);
    }

    public function updateNumberOfTickets(Demand $demand, int $numberOfTickets): void
    {
        /** @var Demand $demand */
        $demand = $this->manager->getRepository(Demand::class)->find($demand->getId());

        if ($demand->getNumberOfTickets() != $numberOfTickets) {
            $demand->setNumberOfTickets($numberOfTickets);
        }

        $this->manager->flush();
    }
}
