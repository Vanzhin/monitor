<?php

declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Query\FindMonitor;


use App\Share\Application\Query\Query;

readonly class FindMonitorQuery extends Query
{
    public function __construct(public string $monitorId)
    {
    }
}
