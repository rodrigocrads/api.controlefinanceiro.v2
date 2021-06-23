<?php

namespace FinancialControl\Actions\FixedExpense;

use Closure;
use Illuminate\Support\Collection;
use FinancialControl\Models\FixedExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\FixedExpenseOrRevenueResponse;

class ListAll extends AbstractAction
{
    public function run()
    {
        $fixedExpenses = FixedExpense::all();

        if ($fixedExpenses->isEmpty()) {
            return [];
        }

        if ($this->hasFilterByActiveEndDate()) {
            $fixedExpenses = $fixedExpenses->filter(function (FixedExpense $fixedExpense) {
                return $fixedExpense->isActive();
            })
            ->values();
        }

        return $this->buildResponse($fixedExpenses);
    }

    private function hasFilterByActiveEndDate()
    {
        return $this->get('filter.endDate') === 'active';
    }

    private function buildResponse(Collection $fixedExpenses): array
    {
        $fixedExpensesResponseData = array_map(function (FixedExpense $fixedExpense) {

            return (new FixedExpenseOrRevenueResponse($fixedExpense))->toArray();
        }, $fixedExpenses->all());

        return $fixedExpensesResponseData;
    }
}