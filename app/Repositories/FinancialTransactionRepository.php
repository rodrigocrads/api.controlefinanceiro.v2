<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Models\FinancialTransaction;
use App\Repositories\Base\Repository;
use App\Custom\DTO\Report\CategoryTotalDTO;

class FinancialTransactionRepository extends Repository
{
    public function __construct(FinancialTransaction $model)
    {
        parent::__construct($model);
    }

    public function getTotalExpenses(string $startDatePeriod, string $endDatePeriod): float
    {
        return $this->listByPeriod($startDatePeriod, $endDatePeriod)
            ->filter(function (FinancialTransaction $item) { return $item->type === 'expense'; })
            ->sum('value');
    }

    public function getTotalRevenues(string $startDatePeriod, string $endDatePeriod): float
    {
        return $this->listByPeriod($startDatePeriod, $endDatePeriod)
            ->filter(function (FinancialTransaction $item) { return $item->type === 'revenue'; })
            ->sum('value');
    }

    public function listByPeriod(string $startDatePeriod, string $endDatePeriod): Collection
    {
        return FinancialTransaction::whereBetween(
                'register_date',
                [ $startDatePeriod, $endDatePeriod ]
            )
            ->get();
    }

    public function getTotalExpensesByCategories(string $startDatePeriod, string $endDatePeriod): Collection
    {
        return FinancialTransaction::whereBetween(
                'register_date',
                [ $startDatePeriod, $endDatePeriod ]
            )
            ->where('type', 'expense')
            ->get()
            ->groupBy('category.name')
            ->map(function (Collection $expenses) {

                return $expenses->sum('value');
            })
            ->map(function ($total, $categoryName) {

                return new CategoryTotalDTO($categoryName, $total);
            });
    }
}