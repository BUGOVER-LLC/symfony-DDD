<?php

declare(strict_types=1);

namespace App\User\Application\Command;

use App\Shared\Application\Command\CommandHandlerInterface;

class CreateUserHandler implements CommandHandlerInterface
{
    public function __invoke(CreateUserCommand $createUSerCommand): string
    {
        // TODO: Implement __invoke() method.
    }
}
