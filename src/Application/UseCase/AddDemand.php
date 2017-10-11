<?php

namespace Application\UseCase;

use Application\UseCase\AddDemand\Command;
use Application\UseCase\AddDemand\Responder;
use Modules\TheatricalPerformance\Domain\Demand;
use Modules\TheatricalPerformance\Domain\DemandRepository;

class AddDemand
{
    private $demandRepository;

    public function __construct(DemandRepository $demandRepository)
    {
        $this->demandRepository = $demandRepository;
    }

    public function execute(Command $command, Responder $responder)
    {
        $demand = new Demand($command->getUrl(), $command->getEmail());

        $this->demandRepository->add($demand);

        $responder->demandWasSuccessfullyAdded();
    }
}
