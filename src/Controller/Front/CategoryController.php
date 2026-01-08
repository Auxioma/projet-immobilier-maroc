<?php

namespace App\Controller\Front;

use App\Entity\Property;
use App\Repository\CategoryRepository;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly PropertyRepository $propertyRepository
    ){}

    #[Route('/listing', name: 'app_front_category')]
    public function index(): Response
    {
        return $this->render('front/category/index.html.twig', [
            'properties' => $this->propertyRepository->findAll(),
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
