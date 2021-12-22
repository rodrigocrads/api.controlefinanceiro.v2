<?php

namespace FinancialControl\Actions\FinancialTransaction;

use FinancialControl\Models\FinancialTransaction;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\Response\FinancialTransactionResponse;

class Save extends AbstractAction
{
    public function run()
    {
        $financialTransaction = new FinancialTransaction($this->data);
        $financialTransaction->saveOrFail();

        return (new FinancialTransactionResponse($financialTransaction))->toArray();
    }
}