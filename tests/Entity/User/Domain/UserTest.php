<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Tests\Entity\User\Domain;

use PHPUnit\Framework\TestCase;
use Jorgeaguero\Docfav\Entity\User\Domain\User;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserName;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserEmail;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserPassword;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserCreatedAt;

final class UserTest extends TestCase
{
    public function testUserEntityCanBeCreated(): void
    {
        $id = new UserId();
        $name = new UserName('Jorge');
        $email = new UserEmail('test@localhost.dev');
        $password = new UserPassword('testinG1!');
        $createdAt = new UserCreatedAt();

        $user = new User($id, $name, $email, $password, $createdAt);

        $this->assertInstanceOf(User::class, $user);
    }
}
