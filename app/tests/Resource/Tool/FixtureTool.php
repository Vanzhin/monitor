<?php

declare(strict_types=1);

namespace App\Tests\Resource\Tool;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;
use App\Tests\Resource\Fixture\Monitor\MonitorFixture;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

trait FixtureTool
{
    public function getDataBaseTool(): AbstractDatabaseTool
    {
        return static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function loadMonitorFixture(): Monitor
    {
        $executor = $this->getDataBaseTool()->loadFixtures([MonitorFixture::class]);

        return $executor->getReferenceRepository()->getReference(MonitorFixture::REFERENCE);
    }
}
