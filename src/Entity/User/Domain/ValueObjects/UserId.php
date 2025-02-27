<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserId
{
    private string $value;

    public function __construct()
    {
        $value = uniqid('', true);
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @param string $value
     * @throws InvalidArgumentException
     */
    private function validate(string $value): void
    {
        // Empty validation
        if (empty($value)) {
            throw new InvalidArgumentException('User id is required');
        }

        // UUID format validation
        if (preg_match('/^[0-9a-f.]{23}$/', $value) !== 1) {
            throw new InvalidArgumentException('Invalid user id');
        }
    }

    final public function value(): string
    {
        return $this->value;
    }
}
