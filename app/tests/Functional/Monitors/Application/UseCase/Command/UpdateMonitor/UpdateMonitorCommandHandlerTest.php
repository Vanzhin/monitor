<?php

namespace Functional\Monitors\Application\UseCase\Command\UpdateMonitor;

use App\Monitors\Application\DTO\Monitor\MonitorDTO;
use App\Monitors\Application\UseCase\Command\UpdateMonitor\UpdateMonitorCommand;
use App\Monitors\Domain\Entity\Monitor;
use App\Monitors\Domain\Factory\MonitorFactory;
use App\Share\Application\Command\CommandBusInterface;
use App\Tests\Resource\Fixture\Monitor\MonitorFixture;
use Faker\Factory;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UpdateMonitorCommandHandlerTest extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->commandBus = static::getContainer()->get(CommandBusInterface::class);
        $this->monitorFactory = static::getContainer()->get(MonitorFactory::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->faker = Factory::create();
    }

    public function test_monitor_created_successfully(): void
    {
        // arrange
        $referenceRepository = $this->databaseTool->loadFixtures([MonitorFixture::class])->getReferenceRepository();
        /** @var Monitor $monitor */
        $monitor = $referenceRepository->getReference(MonitorFixture::REFERENCE);

        $contract = $this->faker->numerify('00####');
        $sipName = $this->faker->numerify('sip##');
        $isActive = $this->faker->boolean(75);

        $setting = [];
        foreach ($this->faker->words(4) as $word) {
            $setting[$word] = $this->faker->word();
        }
        $monitorDTO = new MonitorDTO();
        $monitorDTO->is_active = $isActive;
        $monitorDTO->settings = $setting;
        $monitorDTO->sip_server = $sipName;
        $monitorDTO->contract = $contract;

        // act
        $command = new UpdateMonitorCommand($monitor->getUuid(), $monitorDTO);

        $result = $this->commandBus->execute($command);

        // assert
        $this->assertEquals($monitor->getUuid(), $result->monitorId);
    }
}
