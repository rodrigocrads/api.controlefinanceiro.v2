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

    public function getTotalValue(string $startDate, string $endDate, int $expirationDay): float
    {
        return FixedRevenue::all()
            ->filter(function (FixedRevenue $fixedRevenue) use ($startDate, $endDate, $expirationDay) {

                return $fixedRevenue->isActive($startDate, $endDate) && $fixedRevenue->hasAlreadyExpired($expirationDay);
            })
            ->sum('value');
    }
}