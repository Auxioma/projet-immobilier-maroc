<?php

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository
    ){}

    #[Route('/front/category', name: 'app_front_category')]
    public function index(): Response
    {
        return $this->render('front/category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    public function navbar(): Response
    {
        $navItems = $this->categoryRepository->findBy(
            ['parent' => null]
        );

        return $this->render('front/partials/_navbar.html.twig', [
            'navItems' => $navItems,
        ]);
    }   
}
