<?php

declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Command\UpdateMonitor;


class UpdateMonitorCommandResult
{
    public function __construct(
        public string $monitorId,
    )
    {
    }
}
