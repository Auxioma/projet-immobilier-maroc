<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Admin
        $adminUser = new User();
        $adminUser->setEmail('admin@test.com');
        $adminUser->setRoles(['ROLE_ADMIN']);
        $adminUser->setPassword(
            $this->hasher->hashPassword($adminUser, 'adminpassword')
        );
        $adminUser->setIsVerified(true);
        $manager->persist($adminUser);
        $this->addReference('user-admin', $adminUser);

        // Simple user
        $regularUser = new User();
        $regularUser->setEmail('user@user.com');
        $regularUser->setRoles(['ROLE_USER']);
        $regularUser->setPassword(
            $this->hasher->hashPassword($regularUser, 'userpassword')
        );
        $regularUser->setIsVerified(true);
        $manager->persist($regularUser);
        $this->addReference('user-regular', $regularUser);

        // Users Agences
        for ($i = 0; $i < 50; $i++) {
            $userAgence = new User();
            $userAgence->setEmail($faker->unique()->email());
            $userAgence->setRoles(['ROLE_AGENCE']);
            $userAgence->setPassword(
                $this->hasher->hashPassword($userAgence, 'userpassword')
            );
            $userAgence->setIsVerified(true);
            $manager->persist($userAgence);
            $this->addReference('user-agence-' . $i, $userAgence);
        }

        $manager->flush();
    }
}