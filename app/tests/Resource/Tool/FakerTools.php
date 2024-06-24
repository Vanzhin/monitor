<?php

declare(strict_types=1);

namespace App\Tests\Resource\Tool;

use Faker\Factory;
use Faker\Generator;

trait FakerTools
{
    public function getFaker(): Generator
    {
        return Factory::create();
    }
}
