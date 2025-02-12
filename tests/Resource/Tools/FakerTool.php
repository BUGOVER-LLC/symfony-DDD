<?php

declare(strict_types=1);

namespace App\Tests\Resource\Tools;

use Faker\Factory;
use Faker\Generator;

trait FakerTool
{
    public function getFaker(): Generator
    {
        return Factory::create();
    }
}
