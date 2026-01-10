<?php

namespace App\Controller\AdminUsers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/admin/users/dashboard', name: 'app_admin_users_dashboard')]
    public function index(): Response
    {
        return $this->render('admin_users/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
