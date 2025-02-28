<?php

namespace Tests\Unit;

use App\Domain\User\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testEmailValidation()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email('invalid-email');
    }
}