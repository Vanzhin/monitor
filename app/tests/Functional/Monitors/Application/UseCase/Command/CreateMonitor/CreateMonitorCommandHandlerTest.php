<?php

namespace Functional\Monitors\Application\UseCase\Command\CreateMonitor;

use App\Monitors\Application\UseCase\Command\CreateMonitor\CreateMonitorCommand;
use App\Monitors\Domain\Repository\MonitorRepositoryInterface;
use App\Share\Application\Command\CommandBusInterface;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateMonitorCommandHandlerTest extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = static::getContainer()->get(MonitorRepositoryInterface::class);
        $this->commandBus = static::getContainer()->get(CommandBusInterface::class);
        $this->faker = Factory::create();
    }

    public function test_monitor_created_successfully(): void
    {
        $contract = $this->faker->numerify('00####');
        $sipName = $this->faker->numerify('sip##');
        $isActive = $this->faker->boolean(75);

        $setting = [];
        foreach ($this->faker->words(4) as $word) {
            $setting[$word] = $this->faker->word();
        }
        $command = new CreateMonitorCommand($contract, $sipName, $isActive, $setting);

        $result = $this->commandBus->execute($command);
        $monitor = $this->repository->getByUuid($result->monitorId);
        $this->assertNotEmpty($monitor);
    }
}