<?php

namespace Modules\TheatricalPerformance\Domain;

use Rhumsaa\Uuid\Uuid;

class Demand
{
    private $id;

    private $url;

    private $email;

    public function __construct(string $url, string $email)
    {
        $this->id = Uuid::uuid4();
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
