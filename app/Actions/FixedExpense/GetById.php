<?php

namespace FinancialControl\Actions\FixedExpense;

use FinancialControl\Models\FixedExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Custom\DTO\Response\FixedExpenseOrRevenueResponse;

class GetById extends AbstractAction
{
    public function run()
    {
        $fixedExpense = FixedExpense::find($this->data['id']);

        if ($fixedExpense === null) throw new NotFoundException('Fixed expense not found.');

        return (new FixedExpenseOrRevenueResponse($fixedExpense))->toArray();
    }
}