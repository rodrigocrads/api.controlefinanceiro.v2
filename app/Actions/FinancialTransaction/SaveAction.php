<?php

namespace App\Actions\FinancialTransaction;

use App\Actions\AbstractAction;
use App\Models\FinancialTransaction;

class SaveAction extends AbstractAction
{
    public function run()
    {
        $financialTransaction = new FinancialTransaction($this->data);
        // TODO: Utilizar o metodo create() do FinancialTransactionRepository ao invés do saveOrFail() modelo diretamente
        $financialTransaction->saveOrFail();

        return $financialTransaction->getDTO()->toArray();
    }
}