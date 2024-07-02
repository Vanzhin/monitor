<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Aggregate\Monitor\Specification;

use App\Share\Domain\Specification\SpecificationInterface;

class MonitorSpecification implements MonitorSpecificationInterface
{
    public function __construct(
        public MonitorSettingsSpecification $monitorSettingsSpecification,
    )
    {
    }

}