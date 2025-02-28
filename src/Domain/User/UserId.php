<?php

namespace App\Domain\User;

use Ramsey\Uuid\Uuid;

final class UserId
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(UserId $other): bool
    {
        return $this->value === $other->value;
    }
}