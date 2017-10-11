<?php

namespace Modules\TheatricalPerformance\Domain;

use Rhumsaa\Uuid\Uuid;

class Demand
{
    private $id;

    private $url;

    private $date;

    private $username;

    private $requestedNumberOfTickets;

    private $numberOfTickets;

    public function __construct(string $url, \DateTime $date, string $username, int $requestedNumberOfTickets)
    {
        $this->id = Uuid::uuid4();
        $this->url = $url;
        $this->date = $date;
        $this->username = $username;
        $this->requestedNumberOfTickets = $requestedNumberOfTickets;
        $this->numberOfTickets = null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRequestedNumberOfTickets(): int
    {
        return $this->requestedNumberOfTickets;
    }

    public function getNumberOfTickets(): ?int
    {
        return $this->numberOfTickets;
    }

    public function setNumberOfTickets(int $numberOfTickets): void
    {
        $this->numberOfTickets = $numberOfTickets;
    }
}
