<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects;

use InvalidArgumentException;
use Jorgeaguero\Docfav\Entity\User\Domain\Exceptions\InvalidEmailException;

final class UserEmail
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
            throw new InvalidArgumentException('User email is required');
        }

        // Email format validation
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidEmailException('Invalid user email');
        }
    }

    final public function value(): string
    {
        return $this->value;
    }
}
