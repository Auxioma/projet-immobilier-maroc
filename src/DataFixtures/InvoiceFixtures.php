<?php

namespace App\DataFixtures;

use App\Entity\Invoice;
use App\Entity\InvoiceStatus;
use App\Entity\Agencies;
use App\Entity\AgencySubscription;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class InvoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // On suppose que AgencySubscriptionFixtures a créé 10 abonnements
        for ($i = 0; $i < 10; $i++) {
            /** @var AgencySubscription $subscription */
            $subscription = $this->getReferenceWithClass('agency_subscription_' . $i, AgencySubscription::class);

            /** @var Agencies $agency */
            $agency = $subscription->getAgency();

            // Montants
            $amount = $subscription->getPlan()->getPriceMonthly();
            $taxAmount = (float)$amount * 0.2; // 20% TVA
            $totalAmount = (float)$amount + $taxAmount;

            // Dates mutables pour DATE_MUTABLE
            $dueDate = $faker->dateTimeBetween('+1 week', '+1 month');

            $invoice = new Invoice();
            $invoice
                ->setAgency($agency)
                ->setSubscription($subscription)
                ->setInvoiceNumber('INV-' . str_pad((string)($i + 1), 6, '0', STR_PAD_LEFT))
                ->setAmount((string)$amount)
                ->setTaxAmount(number_format($taxAmount, 2, '.', ''))
                ->setTotalAmount(number_format($totalAmount, 2, '.', ''))
                ->setPdfUrl($faker->optional()->url)
                ->setStatus($faker->randomElement([
                    InvoiceStatus::DRAFT,
                    InvoiceStatus::SENT,
                    InvoiceStatus::PAID,
                    InvoiceStatus::OVERDUE
                ]))
                ->setDueDate($dueDate);

            // Si la facture est payée, utiliser markAsPaid() avec \DateTime mutable
            if ($invoice->getStatus() === InvoiceStatus::PAID) {
                $invoice->markAsPaid(); // markAsPaid() doit être modifié pour utiliser \DateTime
            }

            $manager->persist($invoice);
            $this->addReference('invoice_' . $i, $invoice);
        }

        $manager->flush();
    }

    /**
     * Helper compatible Doctrine 3.x pour getReference
     */
    private function getReferenceWithClass(string $name, string $class)
    {
        return $this->getReference($name, $class);
    }

    public function getDependencies(): array
    {
        return [
            AgencySubscriptionFixtures::class, // Les abonnements doivent exister
        ];
    }
}
