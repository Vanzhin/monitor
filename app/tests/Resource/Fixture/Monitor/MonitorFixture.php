<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Monitor;

use App\Monitors\Domain\Factory\MonitorFactory;
use App\Tests\Resource\Tool\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MonitorFixture extends Fixture
{
    use FakerTools;

    public function __construct(private readonly MonitorFactory $monitorFactory)
    {
    }

    public const REFERENCE = 'monitor';

    public function load(ObjectManager $manager): void
    {
        $contract = $this->getFaker()->numerify('00####');
        $sipName = $this->getFaker()->numerify('sip##');
        $isActive = $this->getFaker()->boolean(75);

        $setting = [];
        foreach ($this->getFaker()->words(4) as $word) {
            $setting[$word] = $this->getFaker()->word();
        }

        $monitor = $this->monitorFactory->create($contract, $sipName, $isActive, $setting);
        $manager->persist($monitor);
        $manager->flush();

        $this->addReference(self::REFERENCE, $monitor);
    }
}
