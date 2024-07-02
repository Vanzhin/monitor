<?php
declare(strict_types=1);


namespace App\Monitors\Domain\Aggregate\Monitor\Specification;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;
use App\Share\Domain\Service\AssertService;
use App\Share\Domain\Specification\SpecificationInterface;

class MonitorSettingsSpecification implements SpecificationInterface
{

    public function satisfy(Monitor $monitor): void
    {
        if (!array_key_exists('phone_numbers', $monitor->getSettings())) {
            throw new \Exception('Phone numbers required.');

        }
        if (!is_bool($monitor->getSettings()['has_inner_calls'] ?? null)) {
            throw new \Exception('Field `has_inner_calls` required.');
        }
        if (!is_array($monitor->getSettings()['phone_numbers'])) {
            throw new \Exception('Phone numbers array required.');

        }
        foreach ($monitor->getSettings()['phone_numbers'] as $number) {
            AssertService::regex($number, "/^\d{10,17}$/", sprintf('Invalid phone number: %s.', $number));
        }
    }
}