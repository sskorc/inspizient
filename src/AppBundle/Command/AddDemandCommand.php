<?php

namespace AppBundle\Command;

use Application\UseCase\AddDemand;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddDemandCommand extends ContainerAwareCommand implements AddDemand\Responder
{
    protected function configure()
    {
        $this
            ->setName('app:demand:add')
            ->setDescription('Add demand')
            ->addArgument(
                'url',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'date',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'username',
                InputArgument::REQUIRED
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        $date = $input->getArgument('date');
        $username = $input->getArgument('username');

        $useCase = $this->getContainer()->get('use_case.add_demand');

        $useCase->execute(
            new AddDemand\Command($url, new \DateTime($date), $username),
            $this
        );

        $output->writeln('Demand was added');
    }


    public function demandWasSuccessfullyAdded()
    {
    }
}
