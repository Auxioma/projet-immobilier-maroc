<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [];

        $data = [
            // Niveau 1
            ['name' => 'Acheter', 'slug' => 'acheter', 'parent' => null],
            ['name' => 'Louer', 'slug' => 'louer', 'parent' => null],
            ['name' => 'Construire', 'slug' => 'construire', 'parent' => null],
            ['name' => 'Vendre', 'slug' => 'vendre', 'parent' => null],

            // Niveau 2
            ['name' => 'Achat', 'slug' => 'achat', 'parent' => 'acheter'],
            ['name' => 'Prix de l\'immobilier', 'slug' => 'prix-immobilier', 'parent' => 'acheter'],
            ['name' => 'Investir', 'slug' => 'investir', 'parent' => 'acheter'],

            ['name' => 'Location', 'slug' => 'location', 'parent' => 'louer'],

            ['name' => 'Construction', 'slug' => 'construction', 'parent' => 'construire'],

            ['name' => 'Vente d’un bien', 'slug' => 'vente-bien', 'parent' => 'vendre'],

            // Niveau 3
            ['name' => 'Appartement ou Maison', 'slug' => 'appartement-maison', 'parent' => 'achat'],
            ['name' => 'Immobilier neuf', 'slug' => 'immobilier-neuf', 'parent' => 'achat'],
            ['name' => 'Terrain', 'slug' => 'terrain', 'parent' => 'achat'],

            ['name' => 'Estimation bien immobilier', 'slug' => 'estimation-bien', 'parent' => 'prix-immobilier'],
            ['name' => 'Prix au m²', 'slug' => 'prix-m2', 'parent' => 'prix-immobilier'],

            ['name' => 'Investissement locatif', 'slug' => 'investissement-locatif', 'parent' => 'investir'],
            ['name' => 'Choisir un agent', 'slug' => 'choisir-agent', 'parent' => 'investir'],

            ['name' => 'Appartement ou Maison', 'slug' => 'appartement-maison-location', 'parent' => 'location'],
            ['name' => 'Location temporaire', 'slug' => 'location-temporaire', 'parent' => 'location'],

            ['name' => 'Logements neufs', 'slug' => 'logements-neufs', 'parent' => 'construction'],
            ['name' => 'Terrain + Maison', 'slug' => 'terrain-maison', 'parent' => 'construction'],

            ['name' => 'Préparer la vente', 'slug' => 'preparer-vente', 'parent' => 'vente-bien'],
            ['name' => 'Mettre en vente', 'slug' => 'mettre-en-vente', 'parent' => 'vente-bien'],
        ];

        // Création
        foreach ($data as $item) {
            $category = new Category();
            $category->setName($item['name']);
            $category->setSlug($item['slug']);

            if ($item['parent']) {
                $category->setParent($categories[$item['parent']]);
            }

            $manager->persist($category);
            $categories[$item['slug']] = $category;
        }

        $manager->flush();
    }
}

