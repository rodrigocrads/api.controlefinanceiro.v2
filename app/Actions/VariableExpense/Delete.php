<?php

namespace FinancialControl\Actions\VariableExpense;

use FinancialControl\Models\VariableExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Exceptions\NotFoundException;

class Delete extends AbstractAction
{
    public function run()
    {
        /** @var VariableExpense */
        $variableExpenseFound = VariableExpense::find($this->data['id']);

        if (empty($variableExpenseFound)) throw new NotFoundException(); 

        $variableExpenseFound->delete();
    }
}