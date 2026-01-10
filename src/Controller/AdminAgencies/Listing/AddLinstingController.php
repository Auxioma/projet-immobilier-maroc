<?php

namespace App\Controller\AdminAgencies\Listing;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/agence/listing', name: 'agence_')]
final class AddLinstingController extends AbstractController
{
    #[Route('/', name: 'listing_show')]
    public function show(): Response
    {
        return $this->render('admin_agencies/listing/add_linsting/index.html.twig', [
            'controller_name' => 'AddLinstingController',
        ]);
    }
}
