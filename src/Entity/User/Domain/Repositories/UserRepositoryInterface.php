<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Domain\Repositories;

use Jorgeaguero\Docfav\Entity\User\Domain\User;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function findById(UserId $userId): ?User;

    public function delete(UserId $userId): void;

    public function findByEmail(string $email): ?User;
}
