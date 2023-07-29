<?php

namespace App\Controller;

use App\Entity\BudgetStats as BudgetStatsEntity;
use App\Repository\ExpenseRepository;
use App\Repository\IncomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

#[AsController]
class BudgetStats extends AbstractController
{
    public function __invoke(
        IncomeRepository  $incomeRepository,
        ExpenseRepository $expenseRepository
    ): BudgetStatsEntity
    {
        return new BudgetStatsEntity($incomeRepository, $expenseRepository);
    }
}
