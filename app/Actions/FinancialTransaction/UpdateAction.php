<?php

namespace FinancialControl\Actions\FinancialTransaction;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\FinancialTransaction;
use FinancialControl\Exceptions\NotFoundException;

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