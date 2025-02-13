<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Application\Query\QueryInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $queryBus,
    ) {
        $this->messageBus = $this->queryBus;
    }

    #[\Override] public function execute(QueryInterface $query): mixed
    {
        $this->handle($query);
    }
}
