<?php
declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Command\CreateMonitor;

use App\Share\Application\Command\Command;


readonly class CreateMonitorCommand extends Command
{
    public function __construct(
        public string $contract,
        public string $sipServer,
        public bool   $isActive,
        public array  $settings
    )
    {
    }
}