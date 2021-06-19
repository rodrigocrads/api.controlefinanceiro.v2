<?php

namespace FinancialControl\Actions\VariableRevenue;

use FinancialControl\Models\VariableRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Custom\DTO\VariableExpenseOrRevenue;

class Update extends AbstractAction
{
    public function run()
    {
        /** @var VariableRevenue */
        $variableRevenue = VariableRevenue::find($this->get('id'));

        if (empty($variableRevenue)) throw new NotFoundException();

        $variableRevenue->update($this->get('update_data'));


        return (new VariableExpenseOrRevenue($variableRevenue))->toArray();
    }
}