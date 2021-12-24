<?php

namespace FinancialControl\Actions\FinancialTransaction;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\FinancialTransaction;

class GetByIdAction extends AbstractAction
{
    public function run()
    {
        /** @var FinancialTransaction */
        $financialTransaction = FinancialTransaction::find($this->data['id']);

        if ($financialTransaction === null) {
            return [];
        }

        return $financialTransaction->getDTO()->toArray();
    }
}