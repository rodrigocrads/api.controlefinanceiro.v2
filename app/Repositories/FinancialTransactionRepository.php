<?php

namespace FinancialControl\Repositories;

use Illuminate\Support\Collection;
use FinancialControl\Models\FinancialTransaction;
use FinancialControl\Repositories\Base\Repository;
use FinancialControl\Custom\DTO\Report\CategoryExpenseTotalDTO;

class FinancialTransactionRepository extends Repository
{
    public function __construct(FinancialTransaction $model)
    {
        parent::__construct($model);
    }

    public function getTotalValue(string $startDatePeriod, string $endDatePeriod): float
    {
        return FinancialTransaction::whereBetween(
                'register_date',
                [ $startDatePeriod, $endDatePeriod ]
            )
            ->get()
            ->sum('value');
    }

    public function getTotalValueByCategories(string $startDatePeriod, string $endDatePeriod): Collection
    {
        return FinancialTransaction::whereBetween(
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