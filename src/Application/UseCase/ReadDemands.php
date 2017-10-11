<?php

namespace Application\UseCase;

use Application\UseCase\ReadDemands\Command;
use Application\UseCase\ReadDemands\Responder;
use Modules\TheatricalPerformance\Domain\Demand;
use Modules\TheatricalPerformance\Domain\DemandRepository;
use Modules\TheatricalPerformance\Domain\NoMatchingPerformanceFoundException;
use Modules\TheatricalPerformance\Domain\PerformanceNotificationService;
use Modules\TheatricalPerformance\Domain\PerformanceScrapingService;

class ReadDemands
{
    private $demandRepository;

    private $performanceScrapingService;

    private $performanceNotificationService;

    public function __construct(
        DemandRepository $demandRepository,
        PerformanceScrapingService $performanceScrapingService,
        PerformanceNotificationService $performanceNotificationService
    ) {
        $this->demandRepository = $demandRepository;
        $this->performanceScrapingService = $performanceScrapingService;
        $this->performanceNotificationService = $performanceNotificationService;
    }

    public function execute(Command $command, Responder $responder)
    {
        try {
            /** @var Demand[] $demands */
            $demands = $this->demandRepository->read();
        } catch (\Exception $e) {
            $responder->failedReadingDemands($e->__toString());

            return;
        }

        $performances = [];
        foreach ($demands as $demand) {
            try {
                $performance = $this->performanceScrapingService->scrap($demand->getUrl(), $demand->getDate());
                $this->performanceNotificationService->notify($performance, $demand->getEmail());
                $performances[] = $performance;
            } catch (NoMatchingPerformanceFoundException $e) {
                continue;
            }
        }

        $responder->performancesSuccessfullyFound($performances);
    }
}
