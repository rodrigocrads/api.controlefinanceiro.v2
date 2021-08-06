<?php

namespace FinancialControl\Repositories;

use Illuminate\Support\Collection;
use FinancialControl\Models\FixedExpense;
use FinancialControl\Repositories\Base\Repository;

class FixedExpenseRepository extends Repository
{
    public function __construct(FixedExpense $model)
    {
        parent::__construct($model);
    }

    public function getTotalValue(string $startDate, string $endDate, int $expirationDay): float
    {
        return $this->all()
            ->filter(function (FixedExpense $fixedRevenue) use ($startDate, $endDate, $expirationDay) {

                return $fixedRevenue->isActive($startDate, $endDate)
                    && $fixedRevenue->hasAlreadyExpired($expirationDay);
            })
            ->sum('value');
    }

    public function getTotalValueByCategories(string $startDate, string $endDate, int $expirationDay): Collection
    {
        return $this->all()
            ->filter(function (FixedExpense $fixedRevenue) use ($startDate, $endDate, $expirationDay) {

                return $fixedRevenue->isActive($startDate, $endDate)
                    && $fixedRevenue->hasAlreadyExpired($expirationDay);
            })
            ->groupBy('category.name')
            ->map(function (Collection $expenses) {

                return $expenses->sum('value');
            });
    }
}