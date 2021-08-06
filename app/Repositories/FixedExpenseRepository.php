<?php

namespace FinancialControl\Repositories;

use FinancialControl\Models\FixedExpense;
use FinancialControl\Repositories\Base\Repository;
use Illuminate\Support\Collection;

class FixedExpenseRepository extends Repository
{
    public function __construct(FixedExpense $model)
    {
        parent::__construct($model);
    }

    public function getTotalValue(string $startDate, string $endDate, int $expirationDay): float
    {
        return FixedExpense::all()
            ->filter(function (FixedExpense $fixedRevenue) use ($startDate, $endDate, $expirationDay) {

                return $fixedRevenue->isActive($startDate, $endDate) && $fixedRevenue->hasAlreadyExpired($expirationDay);
            })
            ->sum('value');
    }

    public function getTotalValueByCategory(string $startDate, string $endDate, int $expirationDay)
    {
        return $this->all()
            ->filter(function (FixedExpense $fixedRevenue) use ($startDate, $endDate, $expirationDay) {

                return $fixedRevenue->isActive($startDate, $endDate) && $fixedRevenue->hasAlreadyExpired($expirationDay);
            })
            ->groupBy('category.name')
            ->map(function (Collection $expenses) {
                return $expenses->sum('value');
            })
            ->toArray();
    }
}