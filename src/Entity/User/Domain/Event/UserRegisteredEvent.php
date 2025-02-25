<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\Event;

use Jorgeaguero\Docfav\Shared\Domain\Event\DomainEvent;
use Jorgeaguero\Docfav\Entity\User\Domain\User;

class UserRegisteredEvent extends DomainEvent
{
    private User $user;

    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    public function user(): User
    {
        return $this->user;
    }
}
