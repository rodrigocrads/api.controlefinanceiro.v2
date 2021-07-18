<?php

namespace FinancialControl\Repositories;

use FinancialControl\Models\FixedExpense;
use FinancialControl\Repositories\Base\Repository;

class FixedExpenseRepository extends Repository
{
    public function __construct(FixedExpense $model)
    {
        parent::__construct($model);
    }

    public function getTotalValue(string $startDate, string $endDate): float
    {
        return FixedExpense::all()
            ->filter(function (FixedExpense $fixedRevenue) use ($startDate, $endDate) {

                return $fixedRevenue->isActive($startDate, $endDate) && $fixedRevenue->hasExpiredDay();
            })
            ->sum('value');
    }
}