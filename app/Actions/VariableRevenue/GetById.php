<?php

namespace FinancialControl\Actions\VariableRevenue;

use FinancialControl\Models\VariableRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\Response\VariableExpenseOrRevenueResponse;

class GetById extends AbstractAction
{
    public function run()
    {
        /** @var VariableRevenue */
        $variableRevenueFound = VariableRevenue::find($this->data['id']);

        if ($variableRevenueFound === null) return [];

        return (new VariableExpenseOrRevenueResponse($variableRevenueFound))->toArray();
    }
}