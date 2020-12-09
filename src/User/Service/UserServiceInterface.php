<?php

declare(strict_types=1);

namespace App\User\Service;

use App\User\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

interface UserServiceInterface
{
    public function registration(User $user, UserPasswordEncoderInterface $passwordEncoder): void;

    public function anonymousRegistration(): User;

    public function checkUserOnAnonymous(User $user): ?User;

    public function deleteUser(User $user): void;
}