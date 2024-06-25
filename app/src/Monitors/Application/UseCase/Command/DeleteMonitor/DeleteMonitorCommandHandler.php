<?php

declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Command\DeleteMonitor;

use App\Monitors\Domain\Repository\MonitorRepositoryInterface;
use App\Monitors\Domain\Service\MonitorFetcher;
use App\Share\Application\Command\CommandHandlerInterface;


readonly class DeleteMonitorCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private MonitorRepositoryInterface $monitorRepository,
        private MonitorFetcher             $monitorFetcher,
    )
    {
    }

    public function __invoke(DeleteMonitorCommand $command): DeleteMonitorCommandResult
    {
        $monitor = $this->monitorFetcher->getRequiredMonitor($command->monitorId);
        $this->monitorRepository->delete($monitor);

        return new DeleteMonitorCommandResult();
    }
}
