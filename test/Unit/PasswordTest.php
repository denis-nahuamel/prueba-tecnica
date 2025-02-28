<?php

namespace Tests\Unit;

use App\Domain\User\Password;
use App\Domain\User\Exception\WeakPasswordException;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testPasswordValidationFails(): void
    {
        $weakPassword = 'weak';

        $this->expectException(WeakPasswordException::class);
        new Password($weakPassword);
    }

    public function testPasswordHashing(): void
    {
        $password = new Password('Password123!');

        $this->assertTrue($password->verify('Password123!'));
    }

    public function testPasswordHashingFailure(): void
    {
        $password = new Password('Password123!');

        $this->assertFalse($password->verify('password123!'));
    }
}

