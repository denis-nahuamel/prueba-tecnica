<?php
namespace App\Domain\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
final class Email
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $value;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email format.");
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}