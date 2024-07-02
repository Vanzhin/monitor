<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Aggregate\Monitor;

use App\Monitors\Domain\Aggregate\Monitor\Specification\MonitorSpecification;
use App\Share\Domain\Service\UuidService;


class Monitor
{
    private string $uuid;
    private array $settings = [];
    private readonly string $contract;
    private string $sip_server;
    private bool $is_active;

    public function __construct(
        string                                $contract,
        string                                $sip_server,
        bool                                  $is_active,
        array                                 $settings,
        private readonly MonitorSpecification $monitorSpecification,
    )
    {
        $this->uuid = UuidService::generate();
        $this->contract = $contract;
        $this->sip_server = $sip_server;
        $this->is_active = $is_active;
        $this->setSettings($settings);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function getContract(): string
    {
        return $this->contract;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getSipServer(): string
    {
        return $this->sip_server;
    }

    public function setSipServer(string $sip_server): void
    {
        $this->sip_server = $sip_server;
    }

    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    public function setSettings(array $settings): void
    {
        $this->settings = $settings;
        $this->monitorSpecification->monitorSettingsSpecification->satisfy($this);
    }
}