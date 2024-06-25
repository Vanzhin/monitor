<?php

declare(strict_types=1);

namespace App\Monitors\Application\UseCase\Query\FindMonitor;

use App\Monitors\Application\DTO\Monitor\MonitorDTOTransformer;
use App\Monitors\Domain\Repository\MonitorRepositoryInterface;
use App\Share\Application\Query\QueryHandlerInterface;


readonly class FindMonitorQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private MonitorRepositoryInterface $monitorRepository,
        private MonitorDTOTransformer      $monitorDTOTransformer
    )
    {
    }

    public function __invoke(FindMonitorQuery $query): FindMonitorQueryResult
    {
        $monitor = $this->monitorRepository->getByUuid($query->monitorId);
        if (!$monitor) {
            return new FindMonitorQueryResult(null);
        }
        $monitorDTO = $this->monitorDTOTransformer->fromMonitorEntity($monitor);

        return new FindMonitorQueryResult($monitorDTO);
    }
}
