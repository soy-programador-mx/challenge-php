<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Infrastructure\Controller;

use Jorgeaguero\Docfav\Entity\User\Application\DTO\RegisterUserRequestDTO;
use Jorgeaguero\Docfav\Entity\User\Application\RegisterUserUseCase;
use Jorgeaguero\Docfav\Entity\User\Infrastructure\Persistence\DoctrineUserRepository;
use Jorgeaguero\Docfav\Shared\Domain\Event\EventBus;
use Jorgeaguero\Docfav\Shared\Infrastructure\DoctrineEntityManager;


class UserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct()
    {
        $this->registerUserUseCase = new RegisterUserUseCase(
            new DoctrineUserRepository(DoctrineEntityManager::getEntityManager()),
            new EventBus()
        );
    }

    public function registerUser(array $request): void
    {
        $registerUserRequestDTO = new RegisterUserRequestDTO(
            $request['name'],
            $request['email'],
            $request['password']
        );

        $this->registerUserUseCase->execute($registerUserRequestDTO);
    }
}
