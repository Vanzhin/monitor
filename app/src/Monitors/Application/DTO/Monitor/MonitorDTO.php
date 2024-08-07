<?php
declare(strict_types=1);

namespace App\Monitors\Application\DTO\Monitor;


class MonitorDTO implements \JsonSerializable
{
    public ?string $id;
    public ?string $contract;
    public ?bool $is_active;
    public ?string $sip_server;
    public ?array $settings;


    #[\Override] public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}