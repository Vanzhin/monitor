<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Factory;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;
use App\Monitors\Domain\Aggregate\Monitor\Specification\MonitorSpecification;

readonly class MonitorFactory
{
    public function __construct(private MonitorSpecification $monitorSpecification)
    {
    }

    public function create(
        string $contract,
        string $sip,
        bool   $isActive = true,
        ?array $setting = null
    ): Monitor
    {
        return new Monitor(
            $contract,
            $sip,
            $isActive,
            $setting,
            $this->monitorSpecification,
        );

    }

}