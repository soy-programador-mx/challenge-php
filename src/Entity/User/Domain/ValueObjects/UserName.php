<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserName
{
    private string $value;

    public function __construct(string $value)
    {
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
            throw new InvalidArgumentException('User name is required');
        }

        // String length validation
        if (strlen($value) < 3 || strlen($value) > 50) {
            throw new InvalidArgumentException('User name must be between 3 and 50 characters');
        }

        // String format validation
        if (preg_match('/^[a-zA-Z0-9_]+$/', $value) !== 1) {
            throw new InvalidArgumentException('Invalid user name');
        }
    }

    final public function value(): string
    {
        return $this->value;
    }
}
