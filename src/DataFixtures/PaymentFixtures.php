<?php

namespace App\DataFixtures;

use App\Entity\Payment;
use App\Entity\PaymentMethod;
use App\Entity\PaymentStatus;
use App\Entity\AgencySubscription;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class PaymentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            /** @var AgencySubscription $subscription */
            $subscription = $this->getReferenceWithClass('agency_subscription_' . $i, AgencySubscription::class);

            $payment = new Payment();
            $payment
                ->setSubscription($subscription)
                ->setAmount($subscription->getPlan()->getPriceMonthly())
                ->setCurrency('EUR')
                ->setPaymentMethod($faker->randomElement([
                    PaymentMethod::CARD,
                    PaymentMethod::BANK_TRANSFER,
                    PaymentMethod::SEPA_DIRECT_DEBIT
                ]))
                ->setStatus($faker->randomElement([
                    PaymentStatus::PENDING,
                    PaymentStatus::COMPLETED,
                    PaymentStatus::FAILED
                ]))
                ->setStripePaymentIntentId($faker->optional()->uuid)
                ->setInvoiceUrl($faker->optional()->url);

            if ($payment->getStatus() === PaymentStatus::COMPLETED) {
                $payment->markAsPaid();
            }

            $manager->persist($payment);
            $this->addReference('payment_' . $i, $payment);
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
            AgencySubscriptionFixtures::class,
        ];
    }
}
