<?php

namespace Jorgeaguero\Docfav\Tests;

use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserName;
use PHPUnit\Framework\TestCase;

class UserNameValueObjectTest extends TestCase
{
    public function testValidUserName(): void
    {
        $name = 'Jorge';
        $userName = new UserName($name);
        $this->assertEquals($name, $userName->value());
    }

    public function testInvalidUserName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $name = 'Jorg$$';
        new UserName($name);
    }

    public function testInvalidUserNameLength(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $name = 'J';
        new UserName($name);
    }

    public function testInvalidUserNameEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $name = '';
        new UserName($name);
    }
}
