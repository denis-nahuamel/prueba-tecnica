<?php
namespace App\Domain\User;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\User\Exception\WeakPasswordException;

/**
 * @ORM\Embeddable
 */
final class Password
{
    private const MIN_LENGTH = 8;
    private const RULES = [
        'Password must be at least %d characters long.' => '/^.{8,}$/',
        'Password must contain at least one uppercase letter.' => '/[A-Z]/',
        'Password must contain at least one number.' => '/[0-9]/',
        'Password must contain at least one special character.' => '/[^A-Za-z0-9]/'
    ];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $value;

    /**
     * Constructor de la clase Password.
     *
     * @param string $value La contraseña en texto plano.
     * @throws WeakPasswordException Si la contraseña no cumple los requisitos.
     */
    public function __construct(string $value)
    {
        $this->validatePassword($value);
        $this->value = password_hash($value, PASSWORD_BCRYPT);
    }

    /**
     * Valida que la contraseña cumpla con los requisitos.
     *
     * @param string $password La contraseña en texto plano.
     * @throws WeakPasswordException Si la contraseña no cumple los requisitos.
     */
    private function validatePassword(string $password): void
    {
        $errors = [];

        foreach (self::RULES as $message => $pattern) {
            if (!preg_match($pattern, $password)) {
                $errors[] = sprintf($message, self::MIN_LENGTH);
            }
        }

        if (!empty($errors)) {
            throw new WeakPasswordException(implode(' ', $errors));
        }
    }

    /**
     * Devuelve el valor hash de la contraseña.
     *
     * @return string El hash de la contraseña.
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * Verifica si una contraseña en texto plano coincide con el hash almacenado.
     *
     * @param string $password La contraseña en texto plano.
     * @return bool True si la contraseña es válida, false en caso contrario.
     */
    public function verify(string $password): bool
    {
        return password_verify($password, $this->value);
    }
}