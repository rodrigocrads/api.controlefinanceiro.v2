<?php

namespace FinancialControl\Actions\VariableRevenue;

use FinancialControl\Models\VariableRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Exceptions\NotFoundException;

class Delete extends AbstractAction
{
    public function run()
    {
        /** @var VariableRevenue */
        $variableRevenueFound = VariableRevenue::find($this->data['id']);

        if (empty($variableRevenueFound)) throw new NotFoundException(); 

        $variableRevenueFound->delete();
    }
}