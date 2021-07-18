<?php

namespace FinancialControl\Actions\VariableExpense;

use FinancialControl\Models\VariableExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\Response\VariableExpenseOrRevenueResponse;

class GetById extends AbstractAction
{
    public function run()
    {
        /** @var VariableExpense */
        $variableExpenseFound = VariableExpense::find($this->data['id']);

        if ($variableExpenseFound === null) return [];

        return (new VariableExpenseOrRevenueResponse($variableExpenseFound))->toArray();
    }
}