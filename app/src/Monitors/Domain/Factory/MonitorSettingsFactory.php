<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Factory;

use App\Monitors\Domain\Aggregate\Monitor\Specification\MonitorSettingsSpecification;
use App\Monitors\Domain\Aggregate\MonitorSettings\MonitorSettings;

readonly class MonitorSettingsFactory
{
    public function __construct(private MonitorSettingsSpecification $monitorSettingsSpecification)
    {
    }

    public function create(bool $hasInnerCalls, string ...$phoneNumbers): MonitorSettings
    {
        return new MonitorSettings(
            $hasInnerCalls,
            $this->monitorSettingsSpecification,
            ...$phoneNumbers,
        );
    }
}