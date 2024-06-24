<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Repository;

use App\Monitors\Domain\Entity\Monitor;

interface MonitorRepositoryInterface
{
    public function add(Monitor $monitor): void;

    public function getByUuid(string $uuid): ?Monitor;

}