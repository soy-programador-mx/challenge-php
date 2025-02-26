<?php

namespace Jorgeaguero\Docfav\Tests\Entity\User\Domain\ValueObjects;

use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function testValidUserId(): void
    {
        $id = uniqid('', true);
        $userId = new UserId($id);
        $this->assertEquals($id, $userId->value());
    }

    public function testInvalidUserId(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $id = 10;
        new UserId($id);
    }

    public function testInvalidUserIdEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $id = '';
        new UserId($id);
    }
}
