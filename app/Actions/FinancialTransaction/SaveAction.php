<?php

namespace App\Actions\FinancialTransaction;

use App\Actions\AbstractAction;
use App\Models\FinancialTransaction;

class SaveAction extends AbstractAction
{
    public function run()
    {
        $financialTransaction = new FinancialTransaction($this->data);
        $financialTransaction->saveOrFail();

        return $financialTransaction->getDTO()->toArray();
    }
}