<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Jorgeaguero\Docfav\Entity\User\Domain\Repositories\UserRepositoryInterface;
use Jorgeaguero\Docfav\Entity\User\Domain\User;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;

final class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function save(User $user): void
    {
        $this->repository->persist($user);
    }

    public function findById(UserId $userId): ?User
    {
        return $this->repository->find($userId->value());
    }

    public function delete(UserId $userId): void
    {
        $user = $this->findById($userId);
        $this->repository->remove($user);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->repository->findOneBy(['email' => $email]);
    }
}
