<?php

declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Command\CreateMonitor;

use App\Monitors\Domain\Service\MonitorMaker;
use App\Share\Application\Command\CommandHandlerInterface;

readonly class CreateMonitorCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private MonitorMaker $monitorMaker,
    )
    {
    }

    public function __invoke(CreateMonitorCommand $command): CreateMonitorCommandResult
    {
        $monitor = $this->monitorMaker->make(
            $command->contract,
            $command->sipServer,
            $command->isActive,
            $command->settings
        );

        return new CreateMonitorCommandResult($monitor->getUuid());
    }
}
