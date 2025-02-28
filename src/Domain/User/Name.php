<?php
namespace App\Domain\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
final class Name
{
    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $value;

    public function __construct(string $value)
    {
        if (strlen($value) < 3) {
            throw new \InvalidArgumentException("Name must be at least 3 characters long.");
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}