<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects;

use InvalidArgumentException;
use Jorgeaguero\Docfav\Entity\User\Domain\Exceptions\WeakPasswordException;

final class UserPassword
{
    private string $value;

    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * @param string $value
     * @throws InvalidArgumentException
     */
    private function validate(string $value): void
    {
        // Empty validation
        if (empty($value)) {
            throw new InvalidArgumentException('User password is required');
        }

        // String length validation
        if (strlen($value) < 8 || strlen($value) > 50) {
            throw new WeakPasswordException('User password must be between 8 and 50 characters');
        }

        // String format validation
        if (preg_match('/^(?=.[A-Za-z])(?=.\d)(?=.[@\(!\)!%*#?&]{8,}$ /', $value) !== 1) {
            throw new WeakPasswordException('Invalid user password');
        }
    }

    final public function value(): string
    {
        return $this->value;
    }
}
