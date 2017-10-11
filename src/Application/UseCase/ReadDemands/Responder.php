<?php

namespace Application\UseCase\ReadDemands;

interface Responder
{
    public function demandsSuccessfullyRead(array $demands);

    public function failedReadingDemands(string $error);
}
