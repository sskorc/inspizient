<?php

namespace Application\UseCase;

use Application\UseCase\ReadDemands\Command;
use Application\UseCase\ReadDemands\Responder;
use Modules\TheatricalPerformance\Domain\DemandRepository;

class ReadDemands
{
    private $demandRepository;

    public function __construct(DemandRepository $demandRepository)
    {
        $this->demandRepository = $demandRepository;
    }

    public function execute(Command $command, Responder $responder)
    {
        try {
            $demands = $this->demandRepository->read();
        } catch (\Exception $e) {
            $responder->failedReadingDemands($e->__toString());

            return;
        }

        $responder->demandsSuccessfullyRead($demands);
    }
}
