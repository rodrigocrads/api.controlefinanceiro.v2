<?php

namespace App\Actions\FinancialTransaction;

use App\Actions\AbstractAction;
use App\Models\FinancialTransaction;
use App\Exceptions\NotFoundException;

class DeleteAction extends AbstractAction
{
    public function run()
    {
        /** @var FinancialTransaction */
        $financialTransactionFound = FinancialTransaction::find($this->data['id']);

        if (empty($financialTransactionFound)) {
            throw new NotFoundException();
        } 

        $financialTransactionFound->delete();
    }
}