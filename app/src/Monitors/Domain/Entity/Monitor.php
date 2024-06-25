<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Entity;

use App\Share\Domain\Service\UuidService;


class Monitor
{
    private string $uuid;


    public function __construct(
        private readonly string $contract,
        private string          $sip_server,
        private bool            $is_active,
        private array           $settings = [],
    )
    {
        $this->uuid = UuidService::generate();
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
    }
}