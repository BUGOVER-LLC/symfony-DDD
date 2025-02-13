<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements CommandBusInterface
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $commandBus,
    ) {
        $this->messageBus = $this->commandBus;
    }

    #[\Override] public function execute(CommandInterface $command): mixed
    {
        $this->handle($command);
    }
}
