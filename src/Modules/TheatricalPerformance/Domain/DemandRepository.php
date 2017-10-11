<?php

namespace Modules\TheatricalPerformance\Domain;

interface DemandRepository
{
    public function add(Demand $demand);
}
