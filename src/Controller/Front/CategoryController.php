<?php

namespace App\Controller\Front;

use App\Entity\Property;
use App\Repository\CategoryRepository;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly PropertyRepository $propertyRepository
    ) {}

    // Page listing classique
    #[Route('/listing', name: 'app_front_category')]
    public function index(): Response
    {
        //$properties = $this->propertyRepository->findAll();

        return $this->render('a.html.twig', [
          
        ]);
    }

    #[Route('/api/properties', name: 'api_properties', methods: ['GET'])]
    public function apiProperties(Request $request): JsonResponse
    {
        $north = $request->query->get('north', 34.05); // par défaut Rabat approx.
        $south = $request->query->get('south', 34.00);
        $east  = $request->query->get('east', -6.80);
        $west  = $request->query->get('west', -6.85);

        $properties = $this->propertyRepository->createQueryBuilder('p')
            ->where('p.latitude BETWEEN :south AND :north')
            ->andWhere('p.longitude BETWEEN :west AND :east')
            ->setParameter('north', $north)
            ->setParameter('south', $south)
            ->setParameter('east', $east)
            ->setParameter('west', $west)
            ->getQuery()
            ->getResult();

        $data = array_map(fn($p) => [
            'id' => $p->getId(),
            'latitude' => $p->getLatitude(),
            'longitude' => $p->getLongitude(),
            'title' => $p->getTitle(),       // Exemple : titre de la propriété
            'price' => $p->getPrice(),       // Exemple : prix
        ], $properties);

        return new JsonResponse($data);
    }

    // Navbar
    public function navbar(): Response
    {
        $navItems = $this->categoryRepository->findBy(['parent' => null]);

        return $this->render('front/partials/_navbar.html.twig', [
            'navItems' => $navItems,
        ]);
    }
}
