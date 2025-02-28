<?php
namespace App\Domain\User\Repository;

use App\Domain\User\User;
use App\Domain\User\Email;
use App\Domain\User\UserId;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\User\Exception\UserAlreadyExistsException;

class DoctrineUserRepository extends EntityRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct($em, $em->getClassMetadata(User::class));
    }

    public function save(User $user): void
    {
        $existingUser = $this->findByEmail($user->email());
        
        if ($existingUser !== null) {
            throw new UserAlreadyExistsException($user->email()->value());
        }

        $this->em->persist($user);
        $this->em->flush();
    }

    public function findById(UserId $id): ?User
    {
        return $this->em->find(User::class, $id->value());
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->findOneBy(['email.value' => $email->value()]);
    }

    public function delete(UserId $id): void
    {
        $user = $this->findById($id);
        if ($user) {
            $this->em->remove($user);
            $this->em->flush();
        }
    }
}