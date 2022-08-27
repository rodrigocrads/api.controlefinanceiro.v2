<?php

namespace App\Actions\FinancialTransaction;

use App\Actions\AbstractAction;
use App\Models\FinancialTransaction;
use App\Exceptions\NotFoundException;

class UpdateAction extends AbstractAction
{
    public function run()
    {
        /** @var FinancialTransaction */
        $financialTransaction = FinancialTransaction::find($this->get('id'));

        if (empty($financialTransaction)) {
            throw new NotFoundException();
        }

        $financialTransaction->update($this->get('update_data'));

        return $financialTransaction->getDTO()->toArray();
    }
}