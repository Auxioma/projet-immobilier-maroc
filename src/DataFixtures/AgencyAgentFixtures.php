<?php
namespace App\DataFixtures;

use App\Entity\AgencyAgent;
use App\Entity\AgencyAgentRole;
use App\Entity\Agencies;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class AgencyAgentFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {}

    public function getDependencies(): array
    {
        return [UserFixtures::class, AgencyFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            // ✅ CORRECTION : Ajout du type de classe (Agencies::class)
            /** @var Agencies $agence */
            $agence = $this->getReference('agence-' . $i, Agencies::class);
            
            // ✅ CORRECTION : Ajout du type de classe (User::class)
            /** @var User $userAgence */
            $userAgence = $this->getReference('user-agence-' . $i, User::class);

            // ADMIN PRINCIPAL
            $agencyAdmin = new AgencyAgent();
            $agencyAdmin->setAgency($agence);
            $agencyAdmin->setUser($userAgence);
            $agencyAdmin->setRole(AgencyAgentRole::ADMIN);
            $agencyAdmin->setIsPrimaryContact(true);
            $manager->persist($agencyAdmin);

        }

        $manager->flush();
    }
}