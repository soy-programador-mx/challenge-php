<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserCreatedAt
{
    private string $value;

    /**
     * @param string $timeZone Default value is 'UTC'
     */
    public function __construct(string $timeZone = 'UTC')
    {
        $this->value = (new \DateTime('now', new \DateTimeZone($timeZone)))->format('Y-m-d H:i:s');
    }

    final public function value(): string
    {
        return $this->value;
    }
}
