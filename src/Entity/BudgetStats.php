<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Controller\BudgetStats as BudgetStatsController;
use App\Controller\UserLogin as UserLoginController;
use App\Repository\ExpenseRepository;
use App\Repository\IncomeRepository;

#[ApiResource(
    operations: [
        new Get(
            controller: BudgetStatsController::class,
            read: false
        ),
        new Get(
            uriTemplate: '/budget_status/{income_category}/{expense_category}',
            controller: BudgetStatsController::class,
            read: false
        ),
    ],
    security: "is_granted('ROLE_USER')"
)]
class BudgetStats
{
    public function __construct(
        private IncomeRepository  $incomeRepository,
        private ExpenseRepository $expenseRepository
    )
    {
    }

    public function getMoneyEarnedToday(): float
    {
        return $this->incomeRepository->countByMoneyEarnedToday();
    }

    public function getMoneyEarnedThisWeek(): float
    {
        return $this->incomeRepository->countByMoneyEarnedThisWeek();
    }

    public function getMoneyEarnedThisMonth(): float
    {
        return $this->incomeRepository->countByMoneyEarnedThisMonth();
    }

    public function getMoneyEarnedThisQuarter(): float
    {
        return $this->incomeRepository->countByMoneyEarnedThisQuarter();
    }

    public function getMoneyEarnedThisYear(): float
    {
        return $this->incomeRepository->countByMoneyEarnedThisYear();
    }

    public function getMoneySpentToday(): float
    {
        return $this->expenseRepository->countByMoneySpentToday();
    }

    public function getMoneySpentThisWeek(): float
    {
        return $this->expenseRepository->countByMoneySpentThisWeek();
    }

    public function getMoneySpentThisMonth(): float
    {
        return $this->expenseRepository->countByMoneySpentThisMonth();
    }

    public function getMoneySpentThisQuarter(): float
    {
        return $this->expenseRepository->countByMoneySpentThisQuarter();
    }

    public function getMoneySpentThisYear(): float
    {
        return $this->expenseRepository->countByMoneySpentThisYear();
    }
}
