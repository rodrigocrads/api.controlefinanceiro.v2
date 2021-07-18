<?php

namespace FinancialControl\Actions\VariableExpense;

use Illuminate\Support\Collection;
use FinancialControl\Models\VariableExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\Response\VariableExpenseOrRevenueResponse;

class ListAll extends AbstractAction
{
    public function run()
    {
        $variableExpenses = VariableExpense::all();

        if ($variableExpenses->isEmpty()) return [];

        return $this->buildResponse($variableExpenses);
    }

    private function buildResponse(Collection $variableExpenses): array
    {
        $variableExpensesResponseData = array_map(function (VariableExpense $variableExpense) {

            return (new VariableExpenseOrRevenueResponse($variableExpense))->toArray();
        }, $variableExpenses->all());

        return $variableExpensesResponseData;
    }
}