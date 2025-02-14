<?php

declare(strict_types=1);

namespace App\Tests\Functional\Shared\Infrastructure\Security;

use App\Shared\Infrastructure\Security\AuthUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * @link AuthUser
 */
class AuthUserTest extends WebTestCase
{
    private Security $security;

    public function test_auth_user_instance_of_success(): void
    {
        self::assertTrue(true);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->security = self::getContainer()->get(Security::class);
    }
}
