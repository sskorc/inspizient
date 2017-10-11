<?php

namespace Application\UseCase\AddDemand;

class Command
{
    private $url;

    private $date;

    private $username;

    public function __construct(string $url, \DateTime $date, string $username)
    {
        $this->url = $url;
        $this->date = $date;
        $this->username = $username;
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
}
