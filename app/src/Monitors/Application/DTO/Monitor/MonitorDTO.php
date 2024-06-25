<?php
declare(strict_types=1);

namespace App\Monitors\Application\DTO\Monitor;


class MonitorDTO
{
    public ?string $id;
    public ?string $contract;
    public ?bool $is_active;
    public ?string $sip_server;
    public ?array $settings;
}