<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/adminaaaa', name: 'admin_')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('administrator/index.html.twig');
    }

    #[Route('/analytics', name: 'analytics')]
    public function analytics(): Response
    {
        return $this->render('administrator/analytics.html.twig');
    }

    #[Route('/finance', name: 'finance')]
    public function finance(): Response
    {
        return $this->render('administrator/finance.html.twig');
    }

    #[Route('/crypto', name: 'crypto')]
    public function crypto(): Response
    {
        return $this->render('administrator/crypto.html.twig');
    }
}
