<?php
declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Command\DeleteMonitor;

use App\Share\Application\Command\Command;


readonly class DeleteMonitorCommand extends Command
{
    public function __construct(public string $monitorId)
    {
    }
}
