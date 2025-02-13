<?php

declare(strict_types=1);

namespace App\User\Application\DTO;

use App\User\Domain\Entity\User;

class UserDto
{
    public function __construct(public readonly string $ulid, public readonly string $email)
    {
    }

    public static function fromEntity(User $user): UserDto
    {
        return new self($user->getUlid(), $user->getEmail());
    }
}
