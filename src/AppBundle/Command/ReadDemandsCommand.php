<?php

namespace AppBundle\Command;

use Application\UseCase\ReadDemands;
use Modules\TheatricalPerformance\Domain\Demand;
use Modules\TheatricalPerformance\Domain\Performance;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadDemandsCommand extends ContainerAwareCommand implements ReadDemands\Responder
{
    private $response;

    protected function configure()
    {
        $this
            ->setName('app:demand:read')
            ->setDescription('Read demands')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $useCase = $this->getContainer()->get('use_case.read_demands');

        $useCase->execute(
            new ReadDemands\Command(),
            $this
        );

        $output->writeln($this->response);
    }

    public function performancesSuccessfullyFound(array $performances)
    {
        $response = sprintf("%s performances found:\n", count($performances));

        /** @var Performance $performance */
        foreach ($performances as $performance) {
            $response .= sprintf("%s\n", $performance);
        }

        $this->response = $response;
    }

    public function failedReadingDemands(string $error)
    {
        $this->response = $error;
    }
}
