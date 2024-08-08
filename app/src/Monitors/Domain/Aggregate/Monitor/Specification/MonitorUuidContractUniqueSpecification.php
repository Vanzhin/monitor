<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Aggregate\Monitor\Specification;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;
use App\Monitors\Domain\Repository\MonitorRepositoryInterface;
use App\Share\Domain\Service\AssertService;
use App\Share\Domain\Specification\SpecificationInterface;

readonly class MonitorUuidContractUniqueSpecification implements SpecificationInterface
{
    public function __construct(private MonitorRepositoryInterface $monitorRepository)
    {
    }

    public function satisfy(Monitor $monitor): void
    {
        $existedMonitor = $this->monitorRepository->getByUuidContract($monitor->getUuidContract());
        AssertService::null(
            $existedMonitor,
            'Monitor with this uuid_contact exists already.'
        );
    }
}