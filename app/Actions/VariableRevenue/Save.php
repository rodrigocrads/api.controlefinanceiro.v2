<?php

namespace FinancialControl\Actions\VariableRevenue;

use FinancialControl\Models\VariableRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\VariableExpenseOrRevenue;

class Save extends AbstractAction
{
    public function run()
    {
        $variableRevenue = new VariableRevenue($this->data);
        $variableRevenue->saveOrFail();

        return (new VariableExpenseOrRevenue($variableRevenue))->toArray();
    }
}