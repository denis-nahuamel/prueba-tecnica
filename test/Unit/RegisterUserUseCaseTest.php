<?php

namespace Tests\Unit;

use App\Application\UseCase\RegisterUserUseCase;
use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Domain\User\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;
use App\Domain\Event\EventDispatcherInterface;
use App\Domain\User\UserRegisteredEvent;

class RegisterUserUseCaseTest extends TestCase
{
    public function testRegisterUser()
    {
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        $eventDispatcher->expects($this->once())
            ->method('dispatch')
            ->with(
                UserRegisteredEvent::class,
                $this->isInstanceOf(UserRegisteredEvent::class)
            );
        $useCase = new RegisterUserUseCase($userRepository, $eventDispatcher);
        $request = new RegisterUserRequest('John Doe', 'john@example.com', 'Password123!');
        $response = $useCase->execute($request);

        $this->assertInstanceOf(UserResponseDTO::class, $response);
    }
}