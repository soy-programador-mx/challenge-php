<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\Exceptions;

class UserAlreadyExistsException extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct(sprintf('The user with email <%s> already exists', $email));
    }
}
