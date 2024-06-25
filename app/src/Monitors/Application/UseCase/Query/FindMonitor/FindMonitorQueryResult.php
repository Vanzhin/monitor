<?php

declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Query\FindMonitor;

use App\Monitors\Application\DTO\Monitor\MonitorDTO;


readonly class FindMonitorQueryResult
{
    public function __construct(public ?MonitorDTO $monitorDTO)
    {
    }
}
