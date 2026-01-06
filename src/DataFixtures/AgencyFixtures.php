<?php
namespace App\DataFixtures;

use App\Entity\Agencies;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class AgencyFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $fakerEn = Factory::create('en_US');
        
        $villesMaroc = [
            'Casablanca', 'Rabat', 'Marrakech', 'Fès', 
            'Tanger', 'Agadir', 'Meknès', 'Oujda'
        ];
        
        $villesMarocAr = [
            'الدار البيضاء', 'الرباط', 'مراكش', 'فاس', 
            'طنجة', 'أكادير', 'مكناس', 'وجدة'
        ];

        $specialites = [
            'la vente de villas et riads',
            'la location de biens haut de gamme',
            'l\'immobilier commercial et bureaux',
            'la gestion de patrimoine immobilier',
            'les investissements locatifs',
            'la promotion immobilière',
            'l\'immobilier touristique',
            'les transactions immobilières'
        ];

        $specialitesAr = [
            'بيع الفيلات والرياضات',
            'تأجير العقارات الفاخرة',
            'العقارات التجارية والمكاتب',
            'إدارة الممتلكات العقارية',
            'الاستثمارات الإيجارية',
            'الترويج العقاري',
            'العقارات السياحية',
            'المعاملات العقارية'
        ];

        for ($i = 0; $i < 50; $i++) {
            /** @var User $userAgence */
            $userAgence = $this->getReference('user-agence-' . $i, User::class);
            
            $villeIndex = $faker->numberBetween(0, count($villesMaroc) - 1);
            $specialiteIndex = $faker->numberBetween(0, count($specialites) - 1);
            $nomEntreprise = $faker->company();

            $agence = new Agencies();
            $agence->setName($nomEntreprise);
            $agence->setNameAr('شركة ' . $nomEntreprise);
            $agence->setRcNumber('RC' . $faker->numerify('########'));
            $agence->setIceNumber($faker->numerify('ICE############'));
            $agence->setPatentNumber('PAT' . $faker->numerify('/####/####'));
            $agence->setAddress(
                $faker->buildingNumber() . ' Rue ' . 
                $faker->streetName() . ', ' . $villesMaroc[$villeIndex]
            );
            $agence->setAddressAr(
                'شارع ' . $faker->streetName() . ' رقم ' . 
                $faker->buildingNumber() . '، ' . $villesMarocAr[$villeIndex]
            );
            $agence->setCity($villesMaroc[$villeIndex]);
            $agence->setCityAr($villesMarocAr[$villeIndex]);
            $agence->setPostalCode($faker->numerify('#####'));
            $agence->setCountry('Maroc');
            $agence->setDescription('Agence spécialisée dans ' . $specialites[$specialiteIndex]);
            $agence->setDescriptionAr('وكالة متخصصة في ' . $specialitesAr[$specialiteIndex]);
            $agence->setLogo('https://picsum.photos/200/200?random=' . $i);
            $agence->setWebsite(
                'https://www.' . 
                strtolower(str_replace([' ', "'", '.'], ['', '', ''], $nomEntreprise)) . '.ma'
            );
            $agence->setFacebook(
                'https://facebook.com/' . 
                strtolower(str_replace([' ', "'", '.'], ['', '', ''], $nomEntreprise))
            );
            $agence->setInstagram(
                'https://instagram.com/' . 
                strtolower(str_replace([' ', "'", '.'], ['', '', ''], $nomEntreprise))
            );
            

            $agence->setUsers($userAgence);     
            
            $manager->persist($agence);
            $this->addReference('agence-' . $i, $agence);
        }

        $manager->flush();
    }
}