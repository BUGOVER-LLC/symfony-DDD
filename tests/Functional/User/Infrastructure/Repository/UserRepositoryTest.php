<?php

declare(strict_types=1);

namespace App\Tests\Functional\User\Infrastructure\Repository;

use App\Tests\Resource\Fixtures\UserFixture;
use App\User\Domain\Factory\UserFactory;
use App\User\Infrastructure\Repository\UserRepository;
use Faker\Factory;
use Faker\Generator;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\ORMDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\User\Domain\Entity\User;

class UserRepositoryTest extends WebTestCase
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var Generator
     */
    private Generator $faker;

    /**
     * @var ORMDatabaseTool
     */
    private ORMDatabaseTool $databaseTool;

    public function test_user_added_success(): void
    {
        $user = (new UserFactory())->create($this->faker->email(), $this->faker->password());
        $this->userRepository->add($user);
        $existsUser = $this->userRepository->findByUlid($user->getUlid());

        // Asserts
        self::assertEquals($user->getUlid(), $existsUser->getUlid());
    }

    public function test_user_find_successfuly(): void
    {
        $executor = $this->databaseTool->loadFixtures([UserFixture::class]);
        $user = $executor->getReferenceRepository()->getReference(
            UserFixture::REFERENCE,
            User::class
        );

        $existUser = $this->userRepository->findByUlid($user->getUlid());

        self::assertEquals($user->getUlid(), $existUser->getUlid());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = static::getContainer()->get(UserRepository::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->faker = Factory::create();
    }
}
