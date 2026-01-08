<?php

namespace App\Controller\AdminAgencies;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/admin/agencies/dashboard', name: 'app_admin_agencies_dashboard')]
    public function index(): Response
    {
        return $this->render('admin_agencies/dashboard/index.html.twig', [
            'controller_name' => 'AdminAgencies/DashboardController',
        ]);
    }

    #[Route('/admin/agencies/dashboard/edit', name: 'app_admin_agencies_dashboard')]
    public function edit(): Response
    {
        return $this->render('admin_agencies/dashboard/edit.html.twig', [
            'controller_name' => 'AdminAgencies/DashboardController',
        ]);
    }
}
