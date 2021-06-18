<?php

namespace FinancialControl\Actions\FixedExpense;

use FinancialControl\Models\FixedExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\ActivationControl;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Custom\DTO\FixedExpenseOrRevenueResponse;

class Update extends AbstractAction
{
    public function run()
    {
        /** @var FixedExpense */
        $fixedExpense = FixedExpense::find($this->get('id'));

        if (empty($fixedExpense)) throw new NotFoundException();

        /** @var ActivationControl */
        $activationControl = ActivationControl::find($fixedExpense->activationControl->id);

        if (empty($activationControl)) throw new NotFoundException();

        $fixedExpense->update($this->get('fixed_expense'));

        $activationControl->update($this->get('fixed_expense.activation_control'));

        return (new FixedExpenseOrRevenueResponse($fixedExpense))->toArray();
    }
}