<?php

namespace FinancialControl\Actions\FinancialTransaction;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\FinancialTransaction;
use FinancialControl\Exceptions\NotFoundException;

class DeleteAction extends AbstractAction
{
    public function run()
    {
        /** @var FinancialTransaction */
        $financialTransactionFound = FinancialTransaction::find($this->data['id']);

        if (empty($financialTransactionFound)) throw new NotFoundException(); 

        $financialTransactionFound->delete();
    }
}