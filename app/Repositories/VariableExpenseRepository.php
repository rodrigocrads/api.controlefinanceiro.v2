<?php

namespace FinancialControl\Repositories;

use FinancialControl\Custom\DTO\Report\CategoryExpenseTotalDTO;
use Illuminate\Support\Collection;
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

    public function getTotalValueByCategories(string $startDatePeriod, string $endDatePeriod): Collection
    {
        return VariableExpense::whereBetween(
                'register_date',
                [ $startDatePeriod, $endDatePeriod ]
            )
            ->get()
            ->groupBy('category.name')
            ->map(function (Collection $expenses) {

                return $expenses->sum('value');
            })
            ->map(function ($total, $categoryName) {
                return new CategoryExpenseTotalDTO($categoryName, $total);
            });
    }
}