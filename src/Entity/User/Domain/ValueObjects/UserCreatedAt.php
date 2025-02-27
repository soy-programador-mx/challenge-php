<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects;

use DateTime;

final class UserCreatedAt
{
    private DateTime $value;

    /**
     * @param string $timeZone Default value is 'UTC'
     */
    public function __construct(string $timeZone = 'UTC')
    {
        $this->value = (new \DateTime('now', new \DateTimeZone($timeZone)));
    }

    final public function value(): DateTime
    {
        return $this->value;
    }
}
