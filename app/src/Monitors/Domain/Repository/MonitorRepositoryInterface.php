<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Repository;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;


interface MonitorRepositoryInterface
{
    public function add(Monitor $monitor): void;

    public function getByUuid(string $uuid): ?Monitor;

    public function getByUuidContract(string $uuidContract): ?Monitor;

    public function delete(Monitor $monitor): void;

}