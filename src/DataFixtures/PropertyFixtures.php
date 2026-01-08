<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Agencies;
use App\Entity\Property;
use App\Entity\EnergyClass;
use App\Entity\PropertyType;
use App\Entity\PropertyStatus;
use App\Entity\TransactionType;
use App\DataFixtures\AgencyFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PropertyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 300; $i++) {
            $property = new Property();

            /** @var Agencies $agency */
            $agency = $this->getReference('agence-' . rand(1, 5), Agencies::class);

            /** @var User $agent */
            $agent = $this->getReference('user-agence-' . rand(1, 10), User::class);

            $property
                ->setReference('PROP-' . strtoupper($faker->bothify('??###')))
                ->setAgency($agency)
                ->setAgent($agent)
                ->setTitle($faker->sentence(4))
                ->setDescription($faker->paragraphs(3, true))
                ->setPropertyType($faker->randomElement(PropertyType::cases()))
                ->setTransactionType($faker->randomElement(TransactionType::cases()))
                ->setRooms($faker->numberBetween(1, 6))
                ->setBedrooms($faker->numberBetween(1, 5))
                ->setBathrooms($faker->numberBetween(1, 3))
                ->setToilets($faker->numberBetween(1, 2))
                ->setFloor($faker->optional()->numberBetween(0, 10))
                ->setTotalFloors($faker->optional()->numberBetween(1, 15))
                ->setLivingArea((string) $faker->randomFloat(2, 30, 200))
                ->setLandArea($faker->optional()->randomFloat(2, 100, 1000))
                ->setConstructionYear($faker->numberBetween(1950, 2023))
                ->setHasElevator($faker->boolean())
                ->setHasParking($faker->boolean())
                ->setHasTerrace($faker->boolean())
                ->setHasBalcony($faker->boolean())
                ->setHasGarden($faker->boolean())
                ->setHasPool($faker->boolean(20))
                ->setHasCellar($faker->boolean())
                ->setHasAirConditioning($faker->boolean())
                ->setHasHeating(true)
                ->setEnergyClass($faker->randomElement(EnergyClass::cases()))
                ->setGesClass($faker->randomElement(EnergyClass::cases()))
                ->setPrice((string) $faker->randomFloat(2, 50000, 950000))
                ->setPricePerSqm((string) $faker->randomFloat(2, 1000, 9000))
                ->setFeesIncluded($faker->boolean())
                ->setChargesMonthly($faker->optional()->randomFloat(2, 50, 300))
                ->setPropertyTaxYearly($faker->optional()->randomFloat(2, 300, 2500))
                ->setAddress($faker->streetAddress())
                ->setCity($faker->city())
                ->setPostalCode($faker->postcode())
                ->setDepartment($faker->departmentName())
                ->setRegion($faker->region())
                ->setCountry('Maroc')
                ->setLatitude((string) $faker->latitude(24.0, 36.0))
                ->setLongitude((string) $faker->longitude(-13.0, -1.0))
                ->setStatus($faker->randomElement(PropertyStatus::cases()))
                ->setIsFeatured($faker->boolean(10))
                ->setIsUrgent($faker->boolean(10))
                ->setIsHighlighted($faker->boolean(15))
                ->setViewCount($faker->numberBetween(0, 500))
                ->setContactCount($faker->numberBetween(0, 50));

            if ($property->getStatus() === PropertyStatus::PUBLISHED) {
                $property->setPublishedAt(new \DateTimeImmutable());
            }

            $manager->persist($property);

            // Ajouter une référence pour chaque propriété
            $this->addReference('property_' . $i, $property);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AgencyFixtures::class,
            UserFixtures::class,
        ];
    }
}
