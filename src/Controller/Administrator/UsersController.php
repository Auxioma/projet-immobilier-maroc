<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    public function users_profile(): Response
    {
        return $this->render('users/profile.html.twig');
    }
   
    public function users_account_settings(): Response
    {
        return $this->render('users/user-account-settings.html.twig');
    }

}
