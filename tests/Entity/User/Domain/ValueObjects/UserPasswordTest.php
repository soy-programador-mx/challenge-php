<?php

namespace Jorgeaguero\Docfav\Tests\Entity\User\Domain\ValueObjects;

use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserPassword;
use PHPUnit\Framework\TestCase;

class UserPasswordTest extends TestCase
{
    public function testValidUserPassword(): void
    {
        $password = 'testinG1!';
        new UserPassword($password);
        $this->assertTrue(true);
    }

    public function testLengthUserPassword(): void
    {
        $this->expectExceptionMessage('User password must be between 8 and 50 characters');
        $password = 'test';
        new UserPassword($password);
    }

    public function testWeakUserPassword(): void
    {
        $this->expectExceptionMessage('User password must contain at least one uppercase letter, one lowercase letter, one number and one special character');
        $password = 'testing001';
        new UserPassword($password);
    }

    public function testInvalidUserPasswordEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $password = '';
        new UserPassword($password);
    }

    public function testVerifyUserPassword(): void
    {
        $password = 'testinG1!';
        $userPassword = new UserPassword($password);
        $this->assertTrue(password_verify($password, $userPassword->value()));
    }
}
