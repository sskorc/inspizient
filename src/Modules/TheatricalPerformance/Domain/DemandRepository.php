<?php

namespace Modules\TheatricalPerformance\Domain;

interface DemandRepository
{
    public function add(Demand $demand);

    public function read(): array;

    public function updateNumberOfTickets(Demand $demand, int $numberOfTickets): void;
}
