<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Service;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;
use App\Monitors\Domain\Factory\MonitorFactory;
use App\Monitors\Domain\Repository\MonitorRepositoryInterface;


final readonly class MonitorMaker
{
    public function __construct(
        private MonitorFactory             $factory,
        private MonitorRepositoryInterface $monitorRepository,
    )
    {
    }

    public function make(
        string  $contract,
        string  $sipServer,
        bool    $isActive,
        array   $settings,
        ?string $uuid_contract = null): Monitor
    {
        $monitor = $this->factory->create($contract, $sipServer, $isActive, $settings, $uuid_contract);
        $this->monitorRepository->add($monitor);

        return $monitor;
    }

}