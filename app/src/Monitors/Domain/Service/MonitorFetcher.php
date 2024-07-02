<?php
declare(strict_types=1);

namespace App\Monitors\Domain\Service;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;
use App\Monitors\Domain\Repository\MonitorRepositoryInterface;
use Webmozart\Assert\Assert;


final readonly class MonitorFetcher
{
    public function __construct(
        private MonitorRepositoryInterface $monitorRepository,
    )
    {
    }

    public function getRequiredMonitor(string $monitorId): Monitor
    {
        $monitor = $this->monitorRepository->getByUuid($monitorId);
        Assert::notNull($monitor, 'No monitor found.');

        return $monitor;
    }
}