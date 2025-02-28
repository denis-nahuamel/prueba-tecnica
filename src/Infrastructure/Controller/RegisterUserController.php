<?php
namespace App\Infrastructure\Controller;

use App\Application\UseCase\RegisterUserUseCase;
use App\Application\DTO\RegisterUserRequest;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function handleRequest(array $requestData): array
    {
        if (!isset($requestData['name']) || !isset($requestData['email']) || !isset($requestData['password'])) {
            return ['error' => 'Invalid request data'];
        }

        $registerUserRequest = new RegisterUserRequest(
            $requestData['name'],
            $requestData['email'],
            $requestData['password']
        );

        $userResponseDTO = $this->registerUserUseCase->execute($registerUserRequest);

        return [
            'id' => $userResponseDTO->id(),
            'name' => $userResponseDTO->name(),
            'email' => $userResponseDTO->email(),
            'createdAt' => $userResponseDTO->createdAt(),
        ];
    }
}