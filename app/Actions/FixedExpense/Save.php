<?php

namespace FinancialControl\Actions\FixedExpense;

use FinancialControl\Models\FixedExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\ActivationControl;
use FinancialControl\Custom\DTO\Response\FixedExpenseOrRevenueResponse;

class Save extends AbstractAction
{
    public function run()
    {
        $fixedExpense = new FixedExpense($this->data);
        $fixedExpense->saveOrFail();

        $activationControlSaveData = array_merge(
            $this->get('activation_control'),
            ['fixed_expense_id' => $fixedExpense->id],
        );

        $activationControl = new ActivationControl($activationControlSaveData);
        $activationControl->saveOrFail();

        return (new FixedExpenseOrRevenueResponse($fixedExpense))->toArray();
    }
}