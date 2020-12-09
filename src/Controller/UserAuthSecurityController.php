<?php

namespace App\Controller;

use App\User\Entity\User;
use App\User\Form\UserForm;
use App\User\Repository\UserRepositoryInterface;
use App\User\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserAuthSecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, UserServiceInterface $userService): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        if ($this->getUser() and $userService->checkUserOnAnonymous($this->getUser())) {
            $user = $userService->checkUserOnAnonymous($this->getUser());
            $this->get('session')->set('anonymousUser', $user);
            $this->get('security.token_storage')->setToken(null);
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepositoryInterface $userRepository,
        UserServiceInterface $userService
    ) {
        $user = new User();
        $user->setRoles(["ROLE_USER"]);
        $form = $this->createForm(UserForm::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userService->registration($user, $passwordEncoder, $userRepository);

            return $this->redirectToRoute('home');
        }

        return $this->render(
            'security/registration.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
