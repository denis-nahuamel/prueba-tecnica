<?php
namespace App\Application\UseCase;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\Name;
use App\Domain\User\Email;
use App\Domain\User\Password;
use App\Domain\User\UserRegisteredEvent;
use App\Domain\Event\EventDispatcherInterface;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        $userId = UserId::generate();
        $name = new Name($request->name());
        $email = new Email($request->email());
        $password = new Password($request->password());

        $user = new User($userId, $name, $email, $password);

        $this->userRepository->save($user);

        $event = new UserRegisteredEvent($userId, $email);
        $this->eventDispatcher->dispatch(UserRegisteredEvent::class, $event);

        return new UserResponseDTO($user);
    }
}