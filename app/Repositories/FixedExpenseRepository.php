<?php

namespace FinancialControl\Repositories;

use Illuminate\Support\Collection;
use FinancialControl\Models\FixedExpense;
use FinancialControl\Repositories\Base\Repository;
use FinancialControl\Custom\DTO\Report\CategoryExpenseTotalDTO;

class FixedExpenseRepository extends Repository
{
    public function __construct(FixedExpense $model)
    {
        parent::__construct($model);
    }

    public function allActivatedAndHasAlreadyExpired(string $startDate, string $endDate, int $expirationDay): Collection
    {
        return $this->all()
            ->filter(function (FixedExpense $fixedExpense) use ($startDate, $endDate, $expirationDay) {

                return $fixedExpense->isActive($startDate, $endDate)
                    && $fixedExpense->hasAlreadyExpired($expirationDay);
            });
    }

    public function getTotalValue(string $startDate, string $endDate, int $expirationDay): float
    {
        return $this->allActivatedAndHasAlreadyExpired($startDate, $endDate, $expirationDay)
            ->sum('value');
    }

    public function getTotalValueByCategories(string $startDate, string $endDate, int $expirationDay): Collection
    {
        return $this->allActivatedAndHasAlreadyExpired($startDate, $endDate, $expirationDay)
            ->groupBy('category.name')
            ->map(function (Collection $expenses) {

                return $expenses->sum('value');
            })
            ->map(function ($total, $categoryName) {
                return new CategoryExpenseTotalDTO($categoryName, $total);
            });
    }
}