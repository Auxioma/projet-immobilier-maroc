<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Agencies;
use App\Entity\AgencyAgent;
use App\Entity\AgencyAgentRole;
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
        $faker = \Faker\Factory::create('fr_FR');
        $faker->addProvider(new \Faker\Provider\en_US\Company($faker));

        $villesMaroc = ['Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Tanger', 'Agadir', 'Meknès', 'Oujda'];
        $villesMarocAr = ['الدار البيضاء', 'الرباط', 'مراكش', 'فاس', 'طنجة', 'أكادير', 'مكناس', 'وجدة'];

        /** ADMIN **/
        $adminUser = new User();
        $adminUser->setEmail('admin@test.com');
        $adminUser->setRoles(['ROLE_ADMIN']);
        $adminUser->setPassword($this->hasher->hashPassword($adminUser, 'adminpassword'));
        $adminUser->setIsVerified(true);
        $manager->persist($adminUser);

        /** USER SIMPLE **/
        $regularUser = new User();
        $regularUser->setEmail('user@user.com');
        $regularUser->setRoles(['ROLE_USER']);
        $regularUser->setPassword($this->hasher->hashPassword($regularUser, 'userpassword'));
        $regularUser->setIsVerified(true);
        $manager->persist($regularUser);

        /** USERS AGENCES **/
        for ($i = 0; $i < 50; $i++) {

            $userAgence = new User();
            $userAgence->setEmail($faker->unique()->email());
            $userAgence->setRoles(['ROLE_AGENCE']);
            $userAgence->setPassword($this->hasher->hashPassword($userAgence, 'userpassword'));
            $userAgence->setIsVerified(true);
            $manager->persist($userAgence);

            /** AGENCE **/
            $villeIndex = $faker->numberBetween(0, count($villesMaroc) - 1);
            $nomEntreprise = $faker->company();

            $agence = new Agencies();
            $agence->setName($nomEntreprise);
            $agence->setNameAr('شركة ' . $nomEntreprise);
            $agence->setRcNumber('RC' . $faker->numerify('########'));
            $agence->setIceNumber($faker->numerify('ICE############'));
            $agence->setPatentNumber('PAT' . $faker->numerify('/####/####'));
            $agence->setAddress(
                $faker->buildingNumber() . ' Rue ' . $faker->streetName() . ', ' . $villesMaroc[$villeIndex]
            );
            $agence->setAddressAr(
                'شارع ' . $faker->streetName() . ' رقم ' . $faker->buildingNumber() . '، ' . $villesMarocAr[$villeIndex]
            );
            $agence->setCity($villesMaroc[$villeIndex]);
            $agence->setCityAr($villesMarocAr[$villeIndex]);
            $agence->setPostalCode($faker->numerify('#####'));
            $agence->setCountry('Maroc');
            $agence->setDescription('Agence spécialisée dans ' . $faker->bs());
            $agence->setDescriptionAr('وكالة متخصصة في ' . $faker->bs());
            $agence->setLogo('https://picsum.photos/200/200?random=' . $i);
            $agence->setWebsite('https://www.' . strtolower(str_replace(' ', '', $nomEntreprise)) . '.ma');
            $agence->setFacebook('https://facebook.com/' . strtolower(str_replace(' ', '', $nomEntreprise)));
            $agence->setInstagram('https://instagram.com/' . strtolower(str_replace(' ', '', $nomEntreprise)));
            $agence->setUsers($userAgence);

            $manager->persist($agence);

            /** AGENCY AGENT : ADMIN PRINCIPAL **/
            $agencyAdmin = new AgencyAgent();
            $agencyAdmin->setAgency($agence);
            $agencyAdmin->setUser($userAgence);
            $agencyAdmin->setRole(AgencyAgentRole::ADMIN);
            $agencyAdmin->setIsPrimaryContact(true);

            $manager->persist($agencyAdmin);

            /** AGENTS SUPPLÉMENTAIRES (2 à 4) **/
            $nbAgents = $faker->numberBetween(2, 4);

            for ($j = 0; $j < $nbAgents; $j++) {

                $agentUser = new User();
                $agentUser->setEmail($faker->unique()->email());
                $agentUser->setRoles(['ROLE_USER']);
                $agentUser->setPassword($this->hasher->hashPassword($agentUser, 'userpassword'));
                $agentUser->setIsVerified(true);

                $manager->persist($agentUser);

                $agent = new AgencyAgent();
                $agent->setAgency($agence);
                $agent->setUser($agentUser);
                $agent->setRole(
                    $faker->randomElement([
                        AgencyAgentRole::AGENT,
                        AgencyAgentRole::VIEWER
                    ])
                );
                $agent->setIsPrimaryContact(false);

                $manager->persist($agent);
            }
        }

        $manager->flush();
    }
}
