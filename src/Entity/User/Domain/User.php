<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain;

use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserCreatedAt;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserEmail;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserName;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserPassword;

/**
 * User entity 
 */
final class User
{
    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;
    private UserCreatedAt $created_at;

    /**
     * @param UserId $id User id
     * @param UserName $name User name
     * @param UserEmail $email User email
     * @param UserPassword $password User password
     * @param UserCreatedAt $createdAt User created at
     */
    public function __construct(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        UserCreatedAt $createdAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $createdAt;
    }

    final public function id(): UserId
    {
        return $this->id;
    }

    final public function name(): UserName
    {
        return $this->name;
    }

    final public function email(): UserEmail
    {
        return $this->email;
    }

    final public function createdAt(): UserCreatedAt
    {
        return $this->created_at;
    }
}
