<?php

declare(strict_types=1);

namespace App\User\Application\Query\FindUser;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\User\Application\DTO\UserDto;
use App\User\Domain\Repository\UserRepositoryInterafce;
use RuntimeException;

class FindUserByEmailQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterafce $userRepositoryInterface)
    {
    }

    public function __invoke(FindUserByEmailQuery $emailQuery): UserDto
    {
        $user = $this->userRepositoryInterface->findByEmail($emailQuery->email);

        if (!$user) {
            throw new RuntimeException('User not found');
        }

        return UserDto::fromEntity($user);
    }
}
