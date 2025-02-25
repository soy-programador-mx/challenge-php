<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Shared\Domain\Event;

class EventBus
{
    private array $handlers = [];

    public function subscribe(string $eventClass, EventHandlerInterface $handler): void
    {
        if (!isset($this->handlers[$eventClass])) {
            $this->handlers[$eventClass] = [];
        }
        $this->handlers[$eventClass][] = $handler;
    }

    public function publish(DomainEvent $event): void
    {
        $eventClass = get_class($event);
        if (isset($this->handlers[$eventClass])) {
            foreach ($this->handlers[$eventClass] as $handler) {
                $handler->handle($event);
            }
        }
    }
}
