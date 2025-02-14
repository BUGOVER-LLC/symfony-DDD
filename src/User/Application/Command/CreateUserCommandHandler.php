<?php

declare(strict_types=1);

namespace App\User\Application\Command;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Repository\UserRepositoryInterafce;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterafce $userRepository,
        private readonly UserFactory $userFactory
    ) {
    }

    public function __invoke(CreateUserCommand $createUSerCommand): string
    {
        $user = $this->userFactory->create($createUSerCommand->email, $createUSerCommand->password);
        $this->userRepository->add($user);

        return $user->getUlid();
    }
}
