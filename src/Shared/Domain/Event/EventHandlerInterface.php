<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Shared\Domain\Event;

interface EventHandlerInterface
{
    public function __invoke(DomainEvent $event): void;
}
