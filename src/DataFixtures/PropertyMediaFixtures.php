<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use App\Entity\PropertyMedia;
use App\Entity\Enum\MediaType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PropertyMediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Image URLs for properties (using placeholder images)
        $imageUrls = [
            'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1616486029423-aaa4789e8c9a?w=800&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1613545325278-f24b0cae1224?w=800&auto=format&fit=crop',
        ];

        // Générer des médias pour chaque propriété
        for ($i = 1; $i <= 20; $i++) {
            try {
                // Récupérer la propriété par référence
                /** @var Property $property */
                $property = $this->getReference('property_' . $i, Property::class);
                
                // Déterminer combien de médias pour cette propriété (3-8)
                $mediaCount = $faker->numberBetween(3, 8);
                
                // Toujours ajouter au moins 2 images
                $imageCount = max(2, $faker->numberBetween(2, 6));
                
                // Déterminer si on ajoute vidéo, visite virtuelle ou plan
                $hasVideo = $faker->boolean(30);
                $hasVirtualTour = $faker->boolean(20);
                $hasFloorPlan = $faker->boolean(40);

                $position = 0;
                
                // Ajouter des images
                for ($j = 0; $j < $imageCount; $j++) {
                    $propertyMedia = new PropertyMedia();
                    
                    $propertyMedia
                        ->setProperty($property)
                        ->setMediaType(MediaType::IMAGE) // Utilisation de l'Enum
                        ->setUrl($imageUrls[$faker->numberBetween(0, count($imageUrls) - 1)])
                        ->setThumbnailUrl($imageUrls[$faker->numberBetween(0, count($imageUrls) - 1)])
                        ->setPosition($position++)
                        ->setCaption($faker->optional(0.7)->sentence(4))
                        ->setIsMain($j === 0) // Première image est principale
                        ->setMimeType('image/jpeg')
                        ->setFileSize($faker->numberBetween(500000, 3000000));
                    
                    $manager->persist($propertyMedia);
                }
                
                // Ajouter vidéo si applicable
                if ($hasVideo) {
                    $propertyMedia = new PropertyMedia();
                    
                    $propertyMedia
                        ->setProperty($property)
                        ->setMediaType(MediaType::VIDEO) // Utilisation de l'Enum
                        ->setUrl('https://www.youtube.com/watch?v=' . $faker->bothify('??####???##'))
                        ->setPosition($position++)
                        ->setCaption($faker->optional(0.7)->sentence(4))
                        ->setIsMain(false)
                        ->setMimeType('video/mp4')
                        ->setFileSize($faker->numberBetween(5000000, 20000000));
                    
                    $manager->persist($propertyMedia);
                }
                
                // Ajouter visite virtuelle si applicable
                if ($hasVirtualTour) {
                    $propertyMedia = new PropertyMedia();
                    
                    $propertyMedia
                        ->setProperty($property)
                        ->setMediaType(MediaType::VIRTUAL_TOUR) // Utilisation de l'Enum
                        ->setUrl('https://my.matterport.com/show/?m=' . $faker->bothify('??####???##'))
                        ->setPosition($position++)
                        ->setCaption($faker->optional(0.7)->sentence(4))
                        ->setIsMain(false);
                    
                    $manager->persist($propertyMedia);
                }
                
                // Ajouter plan si applicable
                if ($hasFloorPlan) {
                    $propertyMedia = new PropertyMedia();
                    
                    $propertyMedia
                        ->setProperty($property)
                        ->setMediaType(MediaType::FLOOR_PLAN) // Utilisation de l'Enum
                        ->setUrl('https://example.com/floorplans/' . $faker->bothify('plan-??##.jpg'))
                        ->setPosition($position++)
                        ->setCaption($faker->optional(0.7)->sentence(4))
                        ->setIsMain(false)
                        ->setMimeType('image/jpeg')
                        ->setFileSize($faker->numberBetween(300000, 1500000));
                    
                    $manager->persist($propertyMedia);
                }
                
            } catch (\Exception $e) {
                // Si la référence n'existe pas, continuer
                continue;
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PropertyFixtures::class,
        ];
    }
}