<?php

namespace Modules\TheatricalPerformance\Domain;

use Rhumsaa\Uuid\Uuid;

class Demand
{
    private $id;

    private $url;

    private $date;

    private $email;

    public function __construct(string $url, \DateTime $date, string $email)
    {
        $this->id = Uuid::uuid4();
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
