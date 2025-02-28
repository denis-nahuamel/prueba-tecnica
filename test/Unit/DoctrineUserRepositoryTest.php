<?php
namespace Tests\Integration\Domain\User\Repository;

use App\Domain\User\Repository\DoctrineUserRepository;
use App\Domain\User\User;
use App\Domain\User\Email;
use App\Domain\User\Name;
use App\Domain\User\Password;
use App\Domain\User\UserId;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class DoctrineUserRepositoryTest extends TestCase
{
    private EntityManager $em;
    private DoctrineUserRepository $repository;

    protected function setUp(): void
    {
        $this->em = require __DIR__ . '/../../bootstrap.php';
        $this->repository = new DoctrineUserRepository($this->em);
        $this->em->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->em->rollback();
    }

    public function testSaveAndFindUser(): void
    {
        $userId = UserId::generate();
        $email = new Email('test@example.com');
        $password = new Password('SecurePass123!');
        $user = new User($userId, new Name('John', 'Doe'), $email, $password);
        
        $this->repository->save($user);
        $foundUser = $this->repository->findById($userId);
        
        $this->assertNotNull($foundUser);
        $this->assertEquals($userId->value(), $foundUser->id()->value());
        $this->assertEquals($email->value(), $foundUser->email()->value());
    }

    public function testFindByEmail(): void
    {
        $userId = UserId::generate();
        $email = new Email('test@example.com');
        $password = new Password('SecurePass123!');
        $user = new User($userId, new Name('John', 'Doe'), $email, $password);
        
        $this->repository->save($user);
        $foundUser = $this->repository->findByEmail($email);
        
        $this->assertNotNull($foundUser);
        $this->assertEquals($email->value(), $foundUser->email()->value());
    }

    public function testDeleteUser(): void
    {
        $userId = UserId::generate();
        $email = new Email('test@example.com');
        $password = new Password('SecurePass123!');
        $user = new User($userId, new Name('John', 'Doe'), $email, $password);
        
        $this->repository->save($user);
        $this->repository->delete($userId);
        $foundUser = $this->repository->findById($userId);
        
        $this->assertNull($foundUser);
    }
}
