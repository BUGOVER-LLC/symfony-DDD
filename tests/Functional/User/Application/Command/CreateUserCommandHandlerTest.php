<?php

declare(strict_types=1);

namespace App\Tests\Functional\User\Application\Command;

use App\Shared\Application\Command\CommandBusInterface;
use App\User\Application\Command\CreateUserCommand;
use App\User\Application\Command\CreateUserCommandHandler;
use App\User\Domain\Repository\UserRepositoryInterafce;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @link CreateUserCommandHandler
 */
class CreateUserCommandHandlerTest extends WebTestCase
{
    public function test_user_created_successfully()
    {
        $command = new CreateUserCommand($this->faker->email(), $this->faker->password());
        $userUlid = $this->commandBus->execute($command);
        $user = $this->userRepository->findByUlid($userUlid);

        self::assertEquals($user->getUlid(), $userUlid);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->commandBus = static::getContainer()->get(CommandBusInterface::class);
        $this->userRepository = static::getContainer()->get(UserRepositoryInterafce::class);
    }
}
