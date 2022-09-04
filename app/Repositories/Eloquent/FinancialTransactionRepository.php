<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Collection;
use App\Models\FinancialTransaction;
use App\Custom\DTO\Report\CategoryTotalDTO;

class FinancialTransactionRepository extends BaseRepository
{
    public function __construct(FinancialTransaction $model)
    {
        parent::__construct($model);
    }

    public function getTotalExpenses(string $startDate, string $endDate): float
    {
        return $this->listByPeriod($startDate, $endDate)
            ->filter(function (FinancialTransaction $item) {

                return $item->type === 'expense';
             })
            ->sum('value');
    }

    public function getTotalRevenues(string $startDate, string $endDate): float
    {
        return $this->listByPeriod($startDate, $endDate)
            ->filter(function (FinancialTransaction $item) {

                return $item->type === 'revenue';
            })
            ->sum('value');
    }

    public function listByPeriod(string $startDate, string $endDate): Collection
    {
        return FinancialTransaction::whereBetween(
                'register_date',
                [ $startDate, $endDate ]
            )
            ->get();
    }

    public function getTotalExpensesByCategories(string $startDate, string $endDate): Collection
    {
        return FinancialTransaction::whereBetween(
                'register_date',
                [ $startDate, $endDate ]
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