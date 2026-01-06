<?php

namespace App\DataFixtures;

use App\Entity\SubscriptionPlan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SubscriptionPlanFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        /* ================= PLANS FIXES ================= */

        $plans = [
            [
                'name' => 'Basic',
                'priceMonthly' => '19.99',
                'priceYearly' => '199.99',
                'maxListings' => 10,
                'maxAgents' => 1,
                'features' => [
                    'Support email',
                    '10 annonces',
                ],
            ],
            [
                'name' => 'Pro',
                'priceMonthly' => '49.99',
                'priceYearly' => '499.99',
                'maxListings' => 50,
                'maxAgents' => 5,
                'features' => [
                    'Support prioritaire',
                    'Statistiques avancées',
                    '50 annonces',
                ],
            ],
            [
                'name' => 'Enterprise',
                'priceMonthly' => '99.99',
                'priceYearly' => '999.99',
                'maxListings' => null,
                'maxAgents' => 20,
                'features' => [
                    'Support dédié',
                    'Annonces illimitées',
                    'Accès API',
                ],
            ],
        ];

        foreach ($plans as $i => $data) {
            $plan = new SubscriptionPlan();

            $plan
                ->setName($data['name'])
                ->setDescription($faker->sentence(12))
                ->setPriceMonthly($data['priceMonthly'])
                ->setPriceYearly($data['priceYearly'])
                ->setMaxListings($data['maxListings'])
                ->setMaxAgents($data['maxAgents'])
                ->setFeatures($data['features'])
                ->setIsActive(true);

            $manager->persist($plan);

            // Ajouter la référence pour les trois plans fixes
            $this->addReference('subscription_plan_' . $i, $plan);
        }

        /* ================= PLANS ALÉATOIRES ================= */

        for ($i = 0; $i < 5; $i++) {
            $plan = new SubscriptionPlan();

            $plan
                ->setName(ucfirst($faker->word) . ' Plan')
                ->setDescription($faker->paragraph)
                ->setPriceMonthly((string) $faker->randomFloat(2, 9, 150))
                ->setPriceYearly(
                    $faker->boolean(70)
                        ? (string) $faker->randomFloat(2, 90, 1500)
                        : null
                )
                ->setMaxListings(
                    $faker->boolean
                        ? $faker->numberBetween(5, 100)
                        : null
                )
                ->setMaxAgents($faker->numberBetween(1, 10))
                ->setFeatures(
                    $faker->randomElements(
                        [
                            'Support email',
                            'Support téléphone',
                            'Statistiques',
                            'Export PDF',
                            'Accès API',
                            'Annonces illimitées',
                        ],
                        $faker->numberBetween(2, 4)
                    )
                )
                ->setIsActive($faker->boolean(90));

            $manager->persist($plan);

            // Ajouter une référence pour les plans aléatoires si nécessaire
            $this->addReference('subscription_plan_random_' . $i, $plan);
        }

        $manager->flush();
    }
}
