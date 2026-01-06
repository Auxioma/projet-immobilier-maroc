<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ){}

    public function load(ObjectManager $manager): void
    {
        // Fixture for admin
        $adminUser = new User();
        $adminUser->setEmail('admin@test.com');
        $adminUser->setRoles(['ROLE_ADMIN']);
        $adminUser->setPassword($this->hasher->hashPassword($adminUser, 'adminpassword'));
        $adminUser->setIsVerified(true);
        $manager->persist($adminUser);

        // Fixture for regular user
        $regularUser = new User();
        $regularUser->setEmail('user@user.com');
        $regularUser->setRoles(['ROLE_USER']);
        $regularUser->setPassword($this->hasher->hashPassword($regularUser, 'userpassword'));
        $regularUser->setIsVerified(true);
        $manager->persist($regularUser);

        /** fixtures des agence au maroc */

        $manager->flush();
    }
}
