<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\Exceptions;

class InvalidEmailException extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct(sprintf('The email <%s> is invalid', $email));
    }
}
