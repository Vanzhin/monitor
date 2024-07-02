<?php
declare(strict_types=1);


namespace App\Tests\Functional\Monitors\Infrastructure\Repository;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;
use App\Monitors\Domain\Factory\MonitorFactory;
use App\Share\Infrastructure\Repository\MonitorRepository;
use App\Tests\Resource\Fixture\Monitor\MonitorFixture;
use Faker\Factory;
use Faker\Generator;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MonitorRepositoryTest extends WebTestCase
{
    private MonitorRepository $repository;
    private Generator $faker;
    private AbstractDatabaseTool $databaseTool;
    private MonitorFactory $monitorFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = static::getContainer()->get(MonitorRepository::class);
        $this->monitorFactory = static::getContainer()->get(MonitorFactory::class);
        $this->faker = Factory::create();
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function test_monitor_added_successfully(): void
    {
        // arrange
        $contract = $this->faker->numerify('00####');
        $sipName = $this->faker->numerify('sip##');
        $isActive = $this->faker->boolean(75);

        $setting = [];
        foreach ($this->faker->words(4) as $word) {
            $setting[$word] = $this->faker->word();
        }
        $monitor = $this->monitorFactory->create($contract, $sipName, $isActive, $setting);
        // act
        $this->repository->add($monitor);

        // assert
        $existedMonitor = $this->repository->getByUuid($monitor->getUuid());
        $this->assertEquals($monitor->getUuid(), $existedMonitor->getUuid());
    }

    public function test_monitor_found_successfully(): void
    {
        // arrange
        $executor = $this->databaseTool->loadFixtures([MonitorFixture::class]);
        /** @var Monitor $monitor */
        $monitor = $executor->getReferenceRepository()->getReference(MonitorFixture::REFERENCE);

        // act
        $existedMonitor = $this->repository->getByUuid($monitor->getUuid());

        // assert
        $this->assertEquals($monitor->getUuid(), $existedMonitor->getUuid());
    }
}