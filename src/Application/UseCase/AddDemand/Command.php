<?php

namespace Application\UseCase\AddDemand;

class Command
{
    private $url;

    private $email;

    public function __construct(string $url, string $email)
    {
        $this->url = $url;
        $this->email = $email;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
