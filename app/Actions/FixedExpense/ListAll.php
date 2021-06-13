<?php

namespace FinancialControl\Actions\FixedExpense;

use Illuminate\Support\Collection;
use FinancialControl\Models\FixedExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\FixedExpenseOrRevenueResponse;

class ListAll extends AbstractAction
{
    public function run()
    {
        $fixedRevenues = FixedExpense::all();

        if ($fixedRevenues->isEmpty()) {
            return [];
        }

        return $this->buildResponse($fixedRevenues);
    }

    private function buildResponse(Collection $fixedRevenues): array
    {
        $fixedExpensesResponseData = array_map(function (FixedExpense $fixedExpense) {

            return (new FixedExpenseOrRevenueResponse($fixedExpense))->toArray();

        }, $fixedRevenues->all());

        return $fixedExpensesResponseData;
    }
}