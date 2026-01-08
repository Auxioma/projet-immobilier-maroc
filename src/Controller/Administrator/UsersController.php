<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/users', name: 'admin_users_')]
class UsersController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('administrator/users/profile.html.twig');
    }

    #[Route('/account-settings', name: 'account_settings')]
    public function accountSettings(): Response
    {
        return $this->render('administrator/users/user-account-settings.html.twig');
    }
}
