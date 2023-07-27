<?php

namespace App\Controller;

use App\Entity\BudgetStats as BudgetStatsEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

#[AsController]
class BudgetStats extends AbstractController
{
    public function __invoke(): BudgetStatsEntity
    {
        return new BudgetStatsEntity();
    }
}
