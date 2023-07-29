<?php

namespace App\Repository;

use App\Entity\Income;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;
use Symfony\Bundle\SecurityBundle\Security;

class IncomeRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry  $registry,
        private Security $security
    )
    {
        parent::__construct($registry, Income::class);
    }

    private function addOwnerFilter($qb): void
    {
        $user = $this->security->getUser();

        if ($user) {
            $qb->andWhere('i.owner = :loggedInUser')
                ->setParameter('loggedInUser', $user->getId());
        }
    }

    public function countByMoneyEarnedToday(): float
    {
        $today = new DateTime('today');
        $qb = $this->createQueryBuilder('i');
        $qb->select('SUM(i.amount)')
            ->where('i.createdAt >= :today')
            ->setParameter('today', $today);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function countByMoneyEarnedThisWeek(): float
    {
        $startOfWeek = new DateTime('this week');
        $qb = $this->createQueryBuilder('i');
        $qb->select('SUM(i.amount)')
            ->where('i.createdAt >= :startOfWeek')
            ->setParameter('startOfWeek', $startOfWeek);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function countByMoneyEarnedThisMonth(): float
    {
        $startOfMonth = new DateTime('first day of this month');
        $qb = $this->createQueryBuilder('i');
        $qb->select('SUM(i.amount)')
            ->where('i.createdAt >= :startOfMonth')
            ->setParameter('startOfMonth', $startOfMonth);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function countByMoneyEarnedThisQuarter(): float
    {
        $currentDate = new \DateTime();
        $quarterStartMonth = (int)ceil($currentDate->format('n') / 3);
        $quarterStart = new \DateTime($currentDate->format('Y') . '-' . ($quarterStartMonth * 3 - 2) . '-01');

        $qb = $this->createQueryBuilder('i');
        $qb->select('SUM(i.amount)')
            ->where('i.createdAt >= :quarterStart')
            ->setParameter('quarterStart', $quarterStart);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function countByMoneyEarnedThisYear(): float
    {
        $currentYear = new DateTime('first day of January this year');

        $qb = $this->createQueryBuilder('i');
        $qb->select('SUM(i.amount)')
            ->where('i.createdAt >= :currentYear')
            ->setParameter('currentYear', $currentYear);

        $this->addOwnerFilter($qb);

        try {
            return (float)$qb->getQuery()->getSingleScalarResult();
        } catch (\Exception $e) {
            return 0;
        }
    }
}
