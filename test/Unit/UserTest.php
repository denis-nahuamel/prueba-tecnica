<?php

namespace Tests\Unit;

use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\Name;
use App\Domain\User\Email;
use App\Domain\User\Password;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreationWithId(): void
    {
        $userId = UserId::generate();
        $name = new Name('John Doe');
        $email = new Email('john@example.com');
        $password = new Password('Password123!');

        $user = new User($userId, $name, $email, $password);

        $this->assertEquals($userId, $user->id());
    }

    public function testUserCreationWithName(): void
    {
        $userId = UserId::generate();
        $name = new Name('John Doe');
        $email = new Email('john@example.com');
        $password = new Password('Password123!');

        $user = new User($userId, $name, $email, $password);

        $this->assertEquals($name, $user->name());
    }

    public function testUserCreationWithEmail(): void
    {
        $userId = UserId::generate();
        $name = new Name('John Doe');
        $email = new Email('john@example.com');
        $password = new Password('Password123!');

        $user = new User($userId, $name, $email, $password);

        $this->assertEquals($email, $user->email());
    }

    public function testUserCreationWithPassword(): void
    {
        $userId = UserId::generate();
        $name = new Name('John Doe');
        $email = new Email('john@example.com');
        $password = new Password('Password123!');

        $user = new User($userId, $name, $email, $password);

        $this->assertEquals($password, $user->password());
    }
}
