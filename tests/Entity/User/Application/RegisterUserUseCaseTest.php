<?php

namespace Jorgeaguero\Docfav\Tests\Entity\User\Application;

use Jorgeaguero\Docfav\Entity\User\Application\RegisterUserUseCase;
use Jorgeaguero\Docfav\Entity\User\Application\DTO\RegisterUserRequestDTO;
use Jorgeaguero\Docfav\Entity\User\Domain\Repositories\UserRepositoryInterface;
use Jorgeaguero\Docfav\Entity\User\Domain\Exceptions\UserAlreadyExistsException;
use Jorgeaguero\Docfav\Entity\User\Application\DTO\UserResponseDTO;
use Jorgeaguero\Docfav\Entity\User\Domain\User;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserCreatedAt;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserEmail;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserName;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserPassword;
use Jorgeaguero\Docfav\Entity\User\Domain\ValueObjects\UserId;
use Jorgeaguero\Docfav\Shared\Domain\Event\EventBus;
use PHPUnit\Framework\TestCase;

class RegisterUserUseCaseTest extends TestCase
{
    private RegisterUserUseCase $registerUserUseCase;
    private UserRepositoryInterface $userRepository;
    private EventBus $eventBus;

    protected function setUp(): void
    {
        $this->eventBus = new EventBus();
    }

    public function testRegisterUser(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->registerUserUseCase = new RegisterUserUseCase($this->userRepository, $this->eventBus);

        $request = new RegisterUserRequestDTO('Jorge', 'jorge@localhost.dev', 'passwordQ1!');
        $response = $this->registerUserUseCase->execute($request);
        $this->assertInstanceOf(UserResponseDTO::class, $response);
    }

    public function testRegisterUserAlreadyExists(): void
    {
        $this->expectException(UserAlreadyExistsException::class);

        $user = new User(
            new UserId(),
            new UserName('Jorge'),
            new UserEmail('jorge@localhost.dev'),
            new UserPassword('passwordQ1!'),
            new UserCreatedAt()
        );

        $this->userRepository = $this->createStub(UserRepositoryInterface::class);
        $this->userRepository->method('findByEmail')
            ->with($user->email()->value())
            ->willReturn($user);

        $this->registerUserUseCase = new RegisterUserUseCase($this->userRepository, $this->eventBus);
        $request = new RegisterUserRequestDTO('Jorge', 'jorge@localhost.dev', 'passwordQ1!');
        $response = $this->registerUserUseCase->execute($request);
    }
}
