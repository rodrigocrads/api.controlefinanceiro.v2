<?php

namespace FinancialControl\Repositories;

use FinancialControl\Models\VariableRevenue;
use FinancialControl\Repositories\Base\Repository;

class VariableRevenueRepository extends Repository
{
    public function __construct(VariableRevenue $model)
    {
        parent::__construct($model);
    }

    public function getTotalValue(string $startDatePeriod, string $endDatePeriod): float
    {
        return VariableRevenue::whereBetween(
                'register_date',
                [ $startDatePeriod, $endDatePeriod ]
            )
            ->get()
            ->sum('value');
    }
}