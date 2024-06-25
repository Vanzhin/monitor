<?php

declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Command\UpdateMonitor;

use App\Monitors\Domain\Repository\MonitorRepositoryInterface;
use App\Monitors\Domain\Service\MonitorFetcher;
use App\Share\Application\Command\CommandHandlerInterface;
use App\Share\Domain\Service\AssertService;


readonly class UpdateMonitorCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private MonitorFetcher             $monitorFetcher,
        private MonitorRepositoryInterface $monitorRepository,
    )
    {
    }

    public function __invoke(UpdateMonitorCommand $command): UpdateMonitorCommandResult
    {
        $monitor = $this->monitorFetcher->getRequiredMonitor($command->monitorId);
        AssertService::notNull($monitor, 'No monitor found.');
        if (!is_null($command->monitorDTO->sip_server)) {
            $monitor->setSipServer($command->monitorDTO->sip_server);
        }
        if (!is_null($command->monitorDTO->is_active)) {
            $monitor->setIsActive($command->monitorDTO->is_active);
        }
        if (!is_null($command->monitorDTO->settings)) {
            $monitor->setSettings($command->monitorDTO->settings);
        }
        $this->monitorRepository->add($monitor);

        return new UpdateMonitorCommandResult($monitor->getUuid());
    }
}
