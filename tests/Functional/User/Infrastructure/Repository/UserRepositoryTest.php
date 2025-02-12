<?php

declare(strict_types=1);

namespace App\Tests\Functional\User\Infrastructure\Repository;

use App\User\Domain\Factory\UserFactory;
use App\User\Infrastructure\Repository\UserRepository;
use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    private Generator $faker;

    public function test_user_added_success(): void
    {
        $user = (new UserFactory())->create($this->faker->email(), $this->faker->password());
        $this->userRepository->add($user);
        $existsUser = $this->userRepository->findByUlid($user->getUlid());

        // Asserts
        self::assertEquals($user->getUlid(), $existsUser->getUlid());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = static::getContainer()->get(UserRepository::class);
        $this->faker = Factory::create();
    }
}
