<?php

namespace App\Controller\AdminAgencies;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/agence', name: 'agence_')]
final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('admin_agencies/dashboard/index.html.twig', [
            'controller_name' => 'AdminAgencies/DashboardController',
        ]);
    }

    #[Route('/dashboard/edit', name: '_dashboard_edit')]
    public function edit(): Response
    {
        return $this->render('admin_agencies/dashboard/edit.html.twig', [
            'controller_name' => 'AdminAgencies/DashboardController',
        ]);
    }
}
