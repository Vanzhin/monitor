<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Entity;

use App\Share\Domain\Service\UuidService;

class Monitor
{
    private string $uuid;


    public function __construct(
        private readonly string $contract,
        private readonly string $sip_server,
        private readonly bool   $is_active,
        private readonly array  $settings = [],
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
}