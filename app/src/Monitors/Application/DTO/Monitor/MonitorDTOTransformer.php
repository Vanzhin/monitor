<?php
declare(strict_types=1);

namespace App\Monitors\Application\DTO\Monitor;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;


class MonitorDTOTransformer
{
    public function fromMonitorEntity(Monitor $monitor): MonitorDTO
    {
        $dto = new MonitorDTO();
        $dto->id = $monitor->getUuid();
        $dto->contract = $monitor->getContract();
        $dto->is_active = $monitor->isActive();
        $dto->sip_server = $monitor->getSipServer();
        $dto->uuid_contract = $monitor->getUuidContract();
        //потом будет отдельный объект
        $dto->settings = $monitor->getSettings();

        return $dto;
    }
}