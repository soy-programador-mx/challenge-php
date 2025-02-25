<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserId
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
            throw new InvalidArgumentException('User id is required');
        }

        // UUID v4 validation
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $value) !== 1) {
            throw new InvalidArgumentException('Invalid user id');
        }
    }

    final public function value(): string
    {
        return $this->value;
    }
}
