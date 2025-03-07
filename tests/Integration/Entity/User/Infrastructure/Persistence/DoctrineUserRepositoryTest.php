<?php

namespace Jorgeaguero\Docfav\Tests\Integration\Entity\User\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;
use Jorgeaguero\Docfav\Entity\User\Domain\User;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserCreatedAt;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserEmail;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserName;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserPassword;
use Jorgeaguero\Docfav\Shared\Infrastructure\DoctrineEntityManager;
use Jorgeaguero\Docfav\Entity\User\Infrastructure\Persistence\DoctrineUserRepository;
use Jorgeaguero\Docfav\Entity\User\Domain\Repositories\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class DoctrineUserRepositoryTest extends TestCase
{
    private EntityManager $entityManager;
    private DoctrineUserRepository $doctrineUserRepository;
    private User $user;

    protected function setUp(): void
    {
        $this->entityManager = DoctrineEntityManager::getEntityManager();

        $this->doctrineUserRepository = new DoctrineUserRepository($this->entityManager);
    }

    public function tearDown(): void
    {
        $this->doctrineUserRepository->delete($this->user->id());
    }

    public function testSaveUser(): void
    {
        $this->user = new User(
            new UserId(),
            new UserName('Jorge'),
            new UserEmail('jorge@localhost.dev'),
            new UserPassword('passwordQ1!'),
            new UserCreatedAt()
        );

        $this->doctrineUserRepository->save($this->user);

        $this->assertTrue(true);
    }
}
