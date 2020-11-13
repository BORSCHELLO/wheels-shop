<?php


namespace App\User\Service;


use App\User\Entity\User;
use App\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

interface UserServiceInterface
{
    public function registration(User $user, UserPasswordEncoderInterface $passwordEncoder, UserRepositoryInterface $userRepository): void;
}