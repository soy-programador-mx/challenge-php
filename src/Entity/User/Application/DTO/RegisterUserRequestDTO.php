<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Application\DTO;

class RegisterUserRequestDTO
{
    private string $name;
    private string $email;
    private string $password;

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    final public function name(): string
    {
        return $this->name;
    }

    final public function email(): string
    {
        return $this->email;
    }

    final public function password(): string
    {
        return $this->password;
    }
}
