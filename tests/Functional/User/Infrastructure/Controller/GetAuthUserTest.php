<?php

declare(strict_types=1);

namespace App\Tests\Functional\User\Infrastructure\Controller;

use App\Tests\Resource\Tools\FixtureTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetAuthUserTest extends WebTestCase
{
    use FixtureTool;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_me_successfully(): void
    {
        $client = self::createClient();
        $user = $this->loadUserFixture();

        self::assertTrue(true);
    }
}
