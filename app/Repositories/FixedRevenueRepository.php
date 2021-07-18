<?php

namespace FinancialControl\Repositories;

use FinancialControl\Models\FixedRevenue;
use FinancialControl\Repositories\Base\Repository;

class FixedRevenueRepository extends Repository
{
    public function __construct(FixedRevenue $model)
    {
        parent::__construct($model);
    }

    public function getTotalValue(string $startDate, string $endDate): float
    {
        return FixedRevenue::all()
            ->filter(function (FixedRevenue $fixedRevenue) use ($startDate, $endDate) {

                return $fixedRevenue->isActive($startDate, $endDate) && $fixedRevenue->hasExpiredDay();
            })
            ->sum('value');
    }
}