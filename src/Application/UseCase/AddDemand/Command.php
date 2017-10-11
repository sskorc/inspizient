<?php

namespace Application\UseCase\AddDemand;

class Command
{
    private $url;

    private $date;

    private $email;

    public function __construct(string $url, \DateTime $date, string $email)
    {
        $this->url = $url;
        $this->date = $date;
        $this->email = $email;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
