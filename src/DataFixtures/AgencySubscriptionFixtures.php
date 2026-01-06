<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Agencies;
use App\Entity\BillingPeriod;
use App\Entity\SubscriptionPlan;
use App\Entity\AgencySubscription;
use App\Entity\SubscriptionStatus;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AgencySubscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        /** @var SubscriptionPlan[] $plans */
        $plans = [];
        for ($i = 0; $i < 3; $i++) {
            $plans[] = $this->getReferenceWithClass('subscription_plan_' . $i, SubscriptionPlan::class);
        }

        /** @var Agencies[] $agencies */
        $agencies = [];
        for ($i = 0; $i < 10; $i++) {
            $agencies[] = $this->getReferenceWithClass('agence-' . $i, Agencies::class);
        }

        foreach ($agencies as $i => $agency) {
            $billingPeriod = $faker->randomElement([BillingPeriod::MONTHLY, BillingPeriod::YEARLY]);
            $startDate = new \DateTimeImmutable('-' . $faker->numberBetween(0, 6) . ' months');
            $endDate = $billingPeriod === BillingPeriod::MONTHLY
                ? $startDate->modify('+1 month')
                : $startDate->modify('+1 year');

            $subscription = new AgencySubscription();
            $subscription
                ->setAgency($agency)
                ->setPlan($faker->randomElement($plans))
                ->setStatus($faker->randomElement([
                    SubscriptionStatus::ACTIVE,
                    SubscriptionStatus::PENDING,
                    SubscriptionStatus::CANCELED,
                    SubscriptionStatus::EXPIRED,
                ]))
                ->setBillingPeriod($billingPeriod)
                ->setCurrentPeriodStart($startDate)
                ->setCurrentPeriodEnd($endDate)
                ->setAutoRenew($faker->boolean(80));

            $manager->persist($subscription);

            // Référence unique pour chaque abonnement
            $this->addReference('agency_subscription_' . $i, $subscription);
        }

        $manager->flush();
    }

    private function getReferenceWithClass(string $name, string $class)
    {
        return $this->getReference($name, $class);
    }

    public function getDependencies(): array
    {
        return [
            SubscriptionPlanFixtures::class,
            AgencyFixtures::class,
        ];
    }
}
