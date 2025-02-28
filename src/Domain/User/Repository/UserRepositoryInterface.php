<?php

namespace App\Domain\User\Repository;

use App\Domain\User\User;
use App\Domain\User\UserId;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function findById(UserId $id): ?User;
    public function delete(UserId $id): void;
}