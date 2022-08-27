<?php

namespace App\Actions\FinancialTransaction;

use App\Actions\AbstractAction;
use App\Models\FinancialTransaction;

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