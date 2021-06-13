<?php

namespace FinancialControl\Actions\FixedExpense;

use FinancialControl\Models\FixedExpense;
use FinancialControl\Actions\AbstractAction;

class Delete extends AbstractAction
{
    public function run()
    {
        /** @var FixedExpense */
        $fixedExpense = FixedExpense::find($this->data['id']);
        $fixedExpense->delete();
    }
}