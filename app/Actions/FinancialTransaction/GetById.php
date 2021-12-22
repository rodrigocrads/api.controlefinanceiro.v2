<?php

namespace FinancialControl\Actions\FinancialTransaction;

use FinancialControl\Models\FinancialTransaction;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\Response\FinancialTransactionResponse;

class GetById extends AbstractAction
{
    public function run()
    {
        /** @var FinancialTransaction */
        $financialTransaction = FinancialTransaction::find($this->data['id']);

        if ($financialTransaction === null) return [];

        return (new FinancialTransactionResponse($financialTransaction))->toArray();
    }
}