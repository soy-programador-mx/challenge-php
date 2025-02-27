<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Infrastructure\Controller;

use Jorgeaguero\Docfav\Entity\User\Application\DTO\RegisterUserRequestDTO;
use Jorgeaguero\Docfav\Entity\User\Application\DTO\UserResponseDTO;
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

    public function registerUser(array $request): UserResponseDTO
    {

        // Validate request
        if (!isset($request['name']) || !isset($request['email']) || !isset($request['password'])) {
            return new UserResponseDTO(false, 'Invalid request');
        }

        try {
            $registerUserRequestDTO = new RegisterUserRequestDTO(
                $request['name'],
                $request['email'],
                $request['password']
            );

            return $this->registerUserUseCase->execute($registerUserRequestDTO);
        } catch (\Exception $e) {
            return new UserResponseDTO(false, $e->getMessage());
        }
    }
}
