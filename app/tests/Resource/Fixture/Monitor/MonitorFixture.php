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

    public const string REFERENCE = 'monitor';

    public function load(ObjectManager $manager): void
    {
        $contract = $this->getFaker()->numerify('00####');
        $sipName = $this->getFaker()->numerify('sip##');
        $isActive = $this->getFaker()->boolean(75);

        $setting = [];
        $setting['has_inner_calls'] = $this->getFaker()->boolean(10);
        for ($i = 1; $i <= $this->getFaker()->numberBetween(1, 6); $i++) {
            $setting['phone_numbers'][] = '7912221' . $this->getFaker()->numberBetween(1111, 9999);
        }

        $monitor = $this->monitorFactory->create($contract, $sipName, $isActive, $setting);
        $manager->persist($monitor);
        $manager->flush();

        $this->addReference(self::REFERENCE, $monitor);
    }
}
