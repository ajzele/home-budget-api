<?php

namespace App\Repository;

use App\Entity\Expense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;
use Symfony\Bundle\SecurityBundle\Security;

class ExpenseRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry  $registry,
        private Security $security
    )
    {
        parent::__construct($registry, Expense::class);
    }

    private function addOwnerFilter($qb): void
    {
        $user = $this->security->getUser();

        if ($user) {
            $qb->andWhere('e.owner = :loggedInUser')
                ->setParameter('loggedInUser', $user->getId());
        }
    }

    public function countByMoneySpentToday(): float
    {
        $today = new DateTime('today');
        $qb = $this->createQueryBuilder('e');
        $qb->select('SUM(e.amount)')
            ->where('e.createdAt >= :today')
            ->setParameter('today', $today);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function countByMoneySpentThisWeek(): float
    {
        $startOfWeek = new DateTime('this week');
        $qb = $this->createQueryBuilder('e');
        $qb->select('SUM(e.amount)')
            ->where('e.createdAt >= :startOfWeek')
            ->setParameter('startOfWeek', $startOfWeek);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function countByMoneySpentThisMonth(): float
    {
        $startOfMonth = new DateTime('first day of this month');
        $qb = $this->createQueryBuilder('e');
        $qb->select('SUM(e.amount)')
            ->where('e.createdAt >= :startOfMonth')
            ->setParameter('startOfMonth', $startOfMonth);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function countByMoneySpentThisQuarter(): float
    {
        $currentDate = new \DateTime();
        $quarterStartMonth = (int)ceil($currentDate->format('n') / 3);
        $quarterStart = new \DateTime($currentDate->format('Y') . '-' . ($quarterStartMonth * 3 - 2) . '-01');

        $qb = $this->createQueryBuilder('e');
        $qb->select('SUM(e.amount)')
            ->where('e.createdAt >= :quarterStart')
            ->setParameter('quarterStart', $quarterStart);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function countByMoneySpentThisYear(): float
    {
        $currentYear = new DateTime('first day of January this year');

        $qb = $this->createQueryBuilder('e');
        $qb->select('SUM(e.amount)')
            ->where('e.createdAt >= :currentYear')
            ->setParameter('currentYear', $currentYear);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }
}
