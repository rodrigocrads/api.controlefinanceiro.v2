<?php

namespace FinancialControl\Repositories;

use FinancialControl\Models\VariableExpense;
use FinancialControl\Repositories\Base\Repository;

class VariableExpenseRepository extends Repository
{
    public function __construct(VariableExpense $model)
    {
        parent::__construct($model);
    }

    public function getTotalValue(string $startDatePeriod, string $endDatePeriod): float
    {
        return VariableExpense::whereBetween(
                'register_date',
                [ $startDatePeriod, $endDatePeriod ]
            )
            ->get()
            ->sum('value');
    }
}