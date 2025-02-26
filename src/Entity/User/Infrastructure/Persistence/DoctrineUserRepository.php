<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Jorgeaguero\Docfav\Entity\User\Domain\Repositories\UserRepositoryInterface;
use Jorgeaguero\Docfav\Entity\User\Domain\User;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;

final class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManager $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findById(UserId $userId): ?User
    {
        return $this->repository->find($userId->value());
    }

    public function delete(UserId $userId): void
    {
        $user = $this->findById($userId);
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->repository->findOneBy(['email' => $email]);
    }
}
