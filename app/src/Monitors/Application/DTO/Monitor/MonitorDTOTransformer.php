<?php
declare(strict_types=1);

namespace App\Monitors\Application\DTO\Monitor;

use App\Monitors\Domain\Entity\Monitor;


class MonitorDTOTransformer
{
    public function fromMonitorEntity(Monitor $monitor): MonitorDTO
    {
        $dto = new MonitorDTO();
        $dto->id = $monitor->getUuid();
        $dto->contract = $monitor->getContract();
        $dto->is_active = $monitor->isActive();
        $dto->sip_server = $monitor->getSipServer();
        //потом будет отдельный объект
        $dto->settings = $monitor->getSettings();

        return $dto;
    }
}