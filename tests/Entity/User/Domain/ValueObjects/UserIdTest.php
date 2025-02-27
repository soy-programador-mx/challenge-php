<?php

namespace Jorgeaguero\Docfav\Tests\Entity\User\Domain\ValueObjects;

use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function testValidUserId(): void
    {
        $userId = new UserId();
        $this->assertTrue(true);
    }
}
