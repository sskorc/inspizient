<?php

namespace Application\UseCase;

use Application\UseCase\ReadDemands\Command;
use Application\UseCase\ReadDemands\Responder;
use Modules\TheatricalPerformance\Domain\DemandRepository;
use Modules\TheatricalPerformance\Domain\PerformanceScrapingService;

class ReadDemands
{
    private $demandRepository;

    private $performanceScrapingService;

    public function __construct(
        DemandRepository $demandRepository,
        PerformanceScrapingService $performanceScrapingService
    ) {
        $this->demandRepository = $demandRepository;
        $this->performanceScrapingService = $performanceScrapingService;
    }

    public function execute(Command $command, Responder $responder)
    {
        try {
            $demands = $this->demandRepository->read();
        } catch (\Exception $e) {
            $responder->failedReadingDemands($e->__toString());

            return;
        }

        $performances = [];
        foreach ($demands as $demand) {
            $performances = array_merge($performances, $this->performanceScrapingService->scrap($demand->getUrl()));
        }

        $responder->performancesSuccessfullyFound($performances);
    }
}
