<?php

namespace Modules\TheatricalPerformance\Infrastructure\Messaging\Slack;

use Maknz\Slack\Client;
use Modules\TheatricalPerformance\Domain\Performance;
use Modules\TheatricalPerformance\Domain\PerformanceNotificationService;

class SlackPerformanceNotificationService implements PerformanceNotificationService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify(Performance $performance, string $username): void
    {
        $message = $this->client->createMessage();

        $message->to('@' . $username)->setText($performance->__toString());

        $this->client->sendMessage($message);
    }
}
