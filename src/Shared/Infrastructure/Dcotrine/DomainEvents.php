<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Dcotrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;

class DomainEvents implements EventSubscriber
{
    public function __construct()
    {
    }

    #[\Override] public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
            Events::postFlush,
            Events::postLoad,
        ];
    }

    public function postPersist(PostPersistEventArgs $args): void
    {
    }
}
