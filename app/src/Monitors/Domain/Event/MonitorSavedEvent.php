<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Event;

use App\Share\Domain\Event\EventInterface;

class MonitorSavedEvent implements EventInterface
{
    public function __construct(public string $monitorId)
    {
    }
}