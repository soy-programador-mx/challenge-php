<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\Exceptions;

class WeakPasswordException extends \Exception
{
    public function __construct()
    {
        parent::__construct('The password is too weak');
    }
}
