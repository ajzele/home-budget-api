<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Controller\BudgetStats as BudgetStatsController;

#[ApiResource(operations: [
    new Get(
        controller: BudgetStatsController::class,
        read: false
    )
])]
class BudgetStats
{
    /**
     * @return float
     */
    public function getMoneyEarned(): float
    {
        return 7600.00; // @todo implement some stat
    }

    /**
     * @return float
     */
    public function getMoneySpent(): float
    {
        return 2300.50; // @todo implement some stat
    }
}
