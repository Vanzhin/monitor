<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Factory;

use App\Monitors\Domain\Entity\Monitor;

readonly class MonitorFactory
{
    public function create(string $contract, string $sip, bool $isActive = true, array $setting = []): Monitor
    {
        return new Monitor(
            $contract,
            $sip,
            $isActive,
            $setting
        );

    }

}