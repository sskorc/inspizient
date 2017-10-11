<?php

namespace Modules\TheatricalPerformance\Domain;

class Demand
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
