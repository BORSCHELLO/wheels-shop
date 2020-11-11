<?php

declare(strict_types=1);

namespace App\User\Repository;

use App\User\Entity\User;

interface UserRepositoryInterface
{
    public function create(User $user): User;

    public function findById(int $id): ?User;
}