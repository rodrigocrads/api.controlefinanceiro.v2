<?php

namespace FinancialControl\Actions\FinancialTransaction;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\FinancialTransaction;

class SaveAction extends AbstractAction
{
    public function run()
    {
        $financialTransaction = new FinancialTransaction($this->data);
        $financialTransaction->saveOrFail();

        return $financialTransaction->getDTO()->toArray();
    }
}