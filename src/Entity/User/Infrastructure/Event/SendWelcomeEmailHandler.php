<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Infrastructure\Event;

use Jorgeaguero\Docfav\Shared\Domain\Event\DomainEvent;
use Jorgeaguero\Docfav\Shared\Domain\Event\EventHandlerInterface;
use Jorgeaguero\Docfav\Entity\User\Domain\Event\UserRegisteredEvent;

class SendWelcomeEmailHandler implements EventHandlerInterface
{
    public function handle(DomainEvent $event): void
    {
        if ($event instanceof UserRegisteredEvent) {
            $user = $event->user();

            // Send welcome email to $user
            echo "Sending welcome email to {$user->email()->value()}\n";
        }
    }
}
