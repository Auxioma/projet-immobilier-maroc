<?php

namespace App\Repository;

use App\Entity\Payment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Payment>
 */
class PaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    /**
     * Trouve tous les paiements de l'année en cours
     */
    public function getMonthlyRevenueTotals(): array
    {
        $year = (int) date('Y');

        $qb = $this->createQueryBuilder('p')
            ->select('MONTH(p.createdAt) as month, SUM(p.amount) as total')
            ->where('p.status = :completed')
            ->andWhere('YEAR(p.createdAt) = :year')
            ->setParameter('completed', 'completed')
            ->setParameter('year', $year)
            ->groupBy('month')
            ->orderBy('month', 'ASC');

        $results = $qb->getQuery()->getArrayResult();

        // Tableau des mois en français
        $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        // Initialisation du tableau avec 0
        $monthlyRevenue = array_fill_keys($months, 0.0);

        // Remplissage avec les totaux récupérés
        foreach ($results as $row) {
            $monthName = $months[(int) $row['month']];
            $monthlyRevenue[$monthName] = (float) $row['total'];
        }

        return $monthlyRevenue;
    }



}
