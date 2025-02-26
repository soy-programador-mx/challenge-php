<?php

namespace Jorgeaguero\Docfav\Tests\Entity\User\Domain\ValueObjects;

use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserEmail;
use PHPUnit\Framework\TestCase;
use Jorgeaguero\Docfav\Entity\User\Domain\Exceptions\InvalidEmailException;

class UserEmailTest extends TestCase
{
    public function testValidUserEmail(): void
    {
        $email = 'jorge@dev.com';
        $userEmail = new UserEmail($email);
        $this->assertEquals($email, $userEmail->value());
    }

    public function testInvalidUserEmail(): void
    {
        $this->expectException(InvalidEmailException::class);
        $email = 'jorge';
        new UserEmail($email);
    }

    public function testInvalidUserEmailEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $email = '';
        new UserEmail($email);
    }
}
