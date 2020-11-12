<?php

declare(strict_types=1);

namespace App\User\Service;


use App\User\Entity\User;
use App\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService implements UserServiceInterface
{
    public function registration(User $user, UserPasswordEncoderInterface $passwordEncoder, UserRepositoryInterface $userRepository)
    {
        $password = $passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($password);

        $userRepository->create($user);
    }
}