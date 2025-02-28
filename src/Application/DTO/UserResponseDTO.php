<?php

namespace App\Application\DTO;

use App\Domain\User\User;

final class UserResponseDTO
{
    private string $id;
    private string $name;
    private string $email;
    private string $createdAt;

    public function __construct(User $user)
    {
        $this->id = $user->id()->value();
        $this->name = $user->name()->value();
        $this->email = $user->email()->value();
        $this->createdAt = $user->createdAt()->format('Y-m-d H:i:s');
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
}