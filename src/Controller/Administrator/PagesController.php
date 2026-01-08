<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin_145f952eds882a/pages', name: 'admin_pages_')]
class PagesController extends AbstractController
{
    #[Route('/knowledge-base', name: 'knowledge_base')]
    public function knowledgeBase(): Response
    {
        return $this->render('administrator/pages/knowledge-base.html.twig');
    }

    #[Route('/contact-us/boxed', name: 'contact_us_boxed')]
    public function contactUsBoxed(): Response
    {
        return $this->render('administrator/pages/contact-us-boxed.html.twig');
    }

    #[Route('/contact-us/cover', name: 'contact_us_cover')]
    public function contactUsCover(): Response
    {
        return $this->render('administrator/pages/contact-us-cover.html.twig');
    }

    #[Route('/faq', name: 'faq')]
    public function faq(): Response
    {
        return $this->render('administrator/pages/faq.html.twig');
    }

    #[Route('/coming-soon/boxed', name: 'coming_soon_boxed')]
    public function comingSoonBoxed(): Response
    {
        return $this->render('administrator/pages/coming-soon-boxed.html.twig');
    }

    #[Route('/coming-soon/cover', name: 'coming_soon_cover')]
    public function comingSoonCover(): Response
    {
        return $this->render('administrator/pages/coming-soon-cover.html.twig');
    }

    #[Route('/error/404', name: 'error_404')]
    public function error404(): Response
    {
        return $this->render('administrator/pages/error404.html.twig');
    }

    #[Route('/error/500', name: 'error_500')]
    public function error500(): Response
    {
        return $this->render('administrator/pages/error500.html.twig');
    }

    #[Route('/error/503', name: 'error_503')]
    public function error503(): Response
    {
        return $this->render('administrator/pages/error503.html.twig');
    }

    #[Route('/maintenance', name: 'maintenance')]
    public function maintenance(): Response
    {
        return $this->render('administrator/pages/maintenance.html.twig');
    }
}
