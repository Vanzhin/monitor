<?php
declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Command\UpdateMonitor;

use App\Monitors\Application\DTO\Monitor\MonitorDTO;
use App\Share\Application\Command\Command;


readonly class UpdateMonitorCommand extends Command
{
    public function __construct(
        public string     $monitorId,
        public MonitorDTO $monitorDTO,
    )
    {
    }
}
