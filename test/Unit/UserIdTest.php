<?php

namespace Tests\Unit;

use App\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function testUserIdGeneration()
    {
        $userId = UserId::generate();
        
        $this->assertNotEmpty($userId->value());
    }

    public function testUserIdEquality()
    {
        $userId1 = UserId::generate();
        $userId2 = new UserId($userId1->value());

        $this->assertTrue($userId1->equals($userId2));
    }
}