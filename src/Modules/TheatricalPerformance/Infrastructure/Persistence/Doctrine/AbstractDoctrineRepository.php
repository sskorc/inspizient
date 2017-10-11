<?php

namespace Modules\TheatricalPerformance\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractDoctrineRepository
{
    /** @var \Doctrine\ORM\EntityManagerInterface */
    protected $manager;

    /**
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
}
