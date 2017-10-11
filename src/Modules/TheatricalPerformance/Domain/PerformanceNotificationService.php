<?php

namespace Modules\TheatricalPerformance\Domain;

interface PerformanceNotificationService
{
    public function notify(Performance $performance, string $email): void;
}
