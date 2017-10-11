<?php

namespace Application\UseCase\AddDemand;

class Command
{
    private $url;

    private $date;

    private $username;

    private $requestedNumberOfTickets;

    public function __construct(string $url, \DateTime $date, string $username, int $requestedNumberOfTickets)
    {
        $this->url = $url;
        $this->date = $date;
        $this->username = $username;
        $this->requestedNumberOfTickets = $requestedNumberOfTickets;
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
}
