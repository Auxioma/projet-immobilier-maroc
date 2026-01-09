<?php

namespace App\Controller\Administrator;

use App\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin_145f952eds882a', name: 'admin_')]
class DashboardController extends AbstractController
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository
    ){}

    #[Route('/', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('administrator/index.html.twig', [
            'paiementAll' => $this->paymentRepository->getMonthlyRevenueTotals()
        ]);
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
