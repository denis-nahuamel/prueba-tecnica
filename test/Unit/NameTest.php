<?php

namespace Tests\Unit;

use App\Domain\User\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testNameValidation()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name('Jo');
    }
}