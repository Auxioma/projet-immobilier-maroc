<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/auth', name: 'admin_auth_')]
class AuthController extends AbstractController
{
    #[Route('/boxed-signin', name: 'boxed_signin')]
    public function boxedSignin(): Response
    {
        return $this->render('administrator/auth/boxed-signin.html.twig');
    }

    #[Route('/boxed-signup', name: 'boxed_signup')]
    public function boxedSignup(): Response
    {
        return $this->render('administrator/auth/boxed-signup.html.twig');
    }

    #[Route('/boxed-lockscreen', name: 'boxed_lockscreen')]
    public function boxedLockscreen(): Response
    {
        return $this->render('administrator/auth/boxed-lockscreen.html.twig');
    }

    #[Route('/boxed-password-reset', name: 'boxed_password_reset')]
    public function boxedPasswordReset(): Response
    {
        return $this->render('administrator/auth/boxed-password-reset.html.twig');
    }

    #[Route('/cover-login', name: 'cover_login')]
    public function coverLogin(): Response
    {
        return $this->render('administrator/auth/cover-login.html.twig');
    }

    #[Route('/cover-register', name: 'cover_register')]
    public function coverRegister(): Response
    {
        return $this->render('administrator/auth/cover-register.html.twig');
    }

    #[Route('/cover-lockscreen', name: 'cover_lockscreen')]
    public function coverLockscreen(): Response
    {
        return $this->render('administrator/auth/cover-lockscreen.html.twig');
    }

    #[Route('/cover-password-reset', name: 'cover_password_reset')]
    public function coverPasswordReset(): Response
    {
        return $this->render('administrator/auth/cover-password-reset.html.twig');
    }
}
