<?php

declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Command\CreateMonitor;


class CreateMonitorCommandResult
{
    public function __construct(
        public string $monitorId,
    )
    {
    }
}
