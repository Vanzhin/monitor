<?php

namespace Functional\Monitors\Application\UseCase\Query\FindMonitor;

use App\Monitors\Application\DTO\Monitor\MonitorDTO;
use App\Monitors\Application\UseCase\Query\FindMonitor\FindMonitorQuery;
use App\Monitors\Domain\Entity\Monitor;
use App\Share\Application\Query\QueryBusInterface;
use App\Tests\Resource\Fixture\Monitor\MonitorFixture;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class FindMonitorQueryHandlerTest extends WebTestCase
{
    private QueryBusInterface $queryBus;
    private AbstractDatabaseTool $databaseTool;

    public function setUp(): void
    {
        parent::setUp();
        $this->queryBus = static::getContainer()->get(QueryBusInterface::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function test_monitor_found_when_query_executed(): void
    {
        // arrange
        $referenceRepository = $this->databaseTool->loadFixtures([MonitorFixture::class])->getReferenceRepository();
        /** @var Monitor $monitor */
        $monitor = $referenceRepository->getReference(MonitorFixture::REFERENCE);
        $query = new FindMonitorQuery($monitor->getUuid());

        // act
        $result = $this->queryBus->execute($query);

        // assert
        $this->assertInstanceOf(MonitorDTO::class, $result->monitorDTO);
    }
}
