<?php

namespace FinancialControl\Actions\VariableExpense;

use FinancialControl\Models\VariableExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\Response\VariableExpenseOrRevenueResponse;

class Save extends AbstractAction
{
    public function run()
    {
        $variableExpense = new VariableExpense($this->data);
        $variableExpense->saveOrFail();

        return (new VariableExpenseOrRevenueResponse($variableExpense))->toArray();
    }
}