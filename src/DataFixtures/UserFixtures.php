<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Agencies;
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
        $facker = \Faker\Factory::create('fr_FR');
        $facker->addProvider(new \Faker\Provider\en_US\Company($facker));

        $villesMaroc = ['Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Tanger', 'Agadir', 'Meknès', 'Oujda'];
        $villesMarocAr = ['الدار البيضاء', 'الرباط', 'مراكش', 'فاس', 'طنجة', 'أكادير', 'مكناس', 'وجدة'];

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

        
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setEmail($facker->unique()->email());
            $user->setRoles(['ROLE_AGENCE']);
            $user->setPassword($this->hasher->hashPassword($user, 'userpassword'));
            $user->setIsVerified(true);
            $manager->persist($user);
            
            // je vais creer les agence associer a chaque user agence
            for ($j = 0; $j < 1; $j++) {
                $villeIndex = $facker->numberBetween(0, count($villesMaroc) - 1);
                $nomEntreprise = $facker->company();

                $agence = new Agencies();
                $agence->setName($nomEntreprise);
                $agence->setNameAr('شركة ' . $nomEntreprise); // Version simplifiée en arabe
                
                $agence->setRcNumber('RC' . $facker->numerify('########'));
                $agence->setIceNumber($facker->numerify('ICE############')); // ICE + 12 chiffres
                $agence->setPatentNumber('PAT' . $facker->numerify('/####/####'));
                $agence->setAddress($facker->buildingNumber() . ' Rue ' . $facker->streetName() . ', ' . $villesMaroc[$villeIndex]);
                $agence->setAddressAr('شارع ' . $facker->streetName() . ' رقم ' . $facker->buildingNumber() . '، ' . $villesMarocAr[$villeIndex]);
                $agence->setCity($villesMaroc[$villeIndex]);
                $agence->setCityAr($villesMarocAr[$villeIndex]);
                $agence->setPostalCode($facker->numerify('#####'));
                $agence->setCountry('Maroc');
                $agence->setDescription('Agence spécialisée dans ' . $facker->bs() . '. ' . $facker->catchPhrase());
                $agence->setDescriptionAr('وكالة متخصصة في ' . $facker->bs() . '. ' . $facker->catchPhrase());
                
                // Contacts
                $agence->setLogo('https://picsum.photos/200/200?random=' . $j);
                $agence->setWebsite('https://www.' . strtolower(str_replace(' ', '', $nomEntreprise)) . '.ma');
                $agence->setFacebook('https://facebook.com/' . strtolower(str_replace(' ', '', $nomEntreprise)) . '_ma');
                $agence->setInstagram('https://instagram.com/' . strtolower(str_replace(' ', '', $nomEntreprise)) . '_official');
                $agence->setUsers($user);
                
                $manager->persist($agence);

            }
            
        }

        $manager->flush();
    }
}
