<?php

namespace Modules\TheatricalPerformance\Domain;

class Performance
{
    private $title;

    private $stage;

    private $date;

    private $numberOfTickets;

    public function __construct(string $title, string $stage, \DateTime $date, int $numberOfTickets)
    {
        $this->title = $title;
        $this->stage = $stage;
        $this->date = $date;
        $this->numberOfTickets = $numberOfTickets;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStage(): string
    {
        return $this->stage;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function getNumberOfTickets(): int
    {
        return $this->numberOfTickets;
    }

    public function __toString(): string
    {
        return sprintf(
            "Title: %s\tStage: %s\tDate: %s\tNoOfTickets: %s",
            $this->getTitle(),
            $this->getStage(),
            $this->getDate()->format('d.m.Y H:i'),
            $this->getNumberOfTickets()
        );
    }
}
