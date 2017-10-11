<?php

namespace Modules\TheatricalPerformance\Domain;

use Rhumsaa\Uuid\Uuid;

class Demand
{
    private $id;

    private $url;

    private $date;

    private $username;

    public function __construct(string $url, \DateTime $date, string $username)
    {
        $this->id = Uuid::uuid4();
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
