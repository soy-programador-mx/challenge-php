<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Entity\User\Application;

use Jorgeaguero\Docfav\Entity\User\Domain\Repositories\UserRepositoryInterface;
use Jorgeaguero\Docfav\Entity\User\Domain\User;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserCreatedAt;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserEmail;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserName;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserPassword;
use Jorgeaguero\Docfav\Entity\User\Domain\Event\UserRegisteredEvent;
use Jorgeaguero\Docfav\Entity\User\Domain\Exceptions\UserAlreadyExistsException;

use Jorgeaguero\Docfav\Entity\User\Application\DTO\RegisterUserRequestDTO;
use Jorgeaguero\Docfav\Entity\User\Application\DTO\UserResponseDTO;
use Jorgeaguero\Docfav\Shared\Domain\Event\EventBus;

final class RegisterUserUseCase
{
    private UserRepositoryInterface $repository;
    private EventBus $eventBus;

    public function __construct(UserRepositoryInterface $repository, EventBus $eventBus)
    {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function execute(RegisterUserRequestDTO $request): UserResponseDTO
    {
        $user = new User(
            new UserId(),
            new UserName($request->name()),
            new UserEmail($request->email()),
            new UserPassword($request->password()),
            new UserCreatedAt()
        );

        if ($this->repository->findByEmail($user->email()->value()) !== null) {
            throw new UserAlreadyExistsException($user->email()->value());
        }

        $this->repository->save($user);

        $this->eventBus->publish(new UserRegisteredEvent($user));

        return new UserResponseDTO(
            $user->id()->value(),
            $user->name()->value(),
            $user->email()->value(),
            $user->createdAt()->value()
        );
    }
}
