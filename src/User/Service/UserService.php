<?php

declare(strict_types=1);

namespace App\User\Service;

use App\User\Entity\User;
use App\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository=$userRepository;
    }

    public function registration(User $user, UserPasswordEncoderInterface $passwordEncoder): void
    {
        $password = $passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($password);

        $this->userRepository->create($user);
    }

    public function anonymousRegistration(): User
    {
        $user = new User();
        $mail = 'anonymous'. strtotime("now"). '@mail.ru';
        $user->setName('Anonymous')
            ->setEmail($mail)
            ->setPhone('anonymous')
            ->setPostalCode(1)
            ->setAddress('anonymous')
            ->setFirstName('Anonymous')
            ->setLastName('Anonymous')
            ->setRoles(['ROLE_ANONYMOUS'])
            ->setPassword('$2y$13$vLqXHDKlbB0QKaC6SX0gTO9VK/PwusIkEBCID3DM7cjr08sCA4fCy');

        $this->userRepository->create($user);

        return $user;
    }

    public function checkUserOnAnonymous(User $user): ?User
    {
        if($user->getRoles()[0] == 'ROLE_ANONYMOUS')
        {
            return $user;
        }
    }

    public function deleteUser(User $user): void
    {
        $this->userRepository->delete($user);
    }
}