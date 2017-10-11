<?php

namespace Application\UseCase\ReadDemands;

interface Responder
{
    public function performancesSuccessfullyFound(array $performances);

    public function failedReadingDemands(string $error);
}
