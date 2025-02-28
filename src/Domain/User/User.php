<?php
namespace App\Domain\User;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\User\Repository\DoctrineUserRepository;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private string $id;

    /**
     * @ORM\Embedded(class="Name")
     */
    private Name $name;

    /**
     * @ORM\Embedded(class="Email")
     */
    private Email $email;

    /**
     * @ORM\Embedded(class="Password")
     */
    private Password $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    public function __construct(UserId $id, Name $name, Email $email, Password $password)
    {
        $this->id = $id->value();
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new \DateTime();
    }

    public function id(): UserId
    {
        return new UserId($this->id);
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }
}