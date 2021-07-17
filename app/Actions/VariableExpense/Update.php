<?php

namespace FinancialControl\Actions\VariableExpense;

use FinancialControl\Models\VariableExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Custom\DTO\Response\VariableExpenseOrRevenueResponse;

class Update extends AbstractAction
{
    public function run()
    {
        /** @var VariableExpense */
        $variableExpense = VariableExpense::find($this->get('id'));

        if (empty($variableExpense)) throw new NotFoundException();

        $variableExpense->update($this->get('update_data'));


        return (new VariableExpenseOrRevenueResponse($variableExpense))->toArray();
    }
}