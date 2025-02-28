<?php

namespace App\Domain\User;

final class UserRegisteredEvent
{
    private UserId $userId;
    private Email $email;

    public function __construct(UserId $userId, Email $email)
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function email(): Email
    {
        return $this->email;
    }
}