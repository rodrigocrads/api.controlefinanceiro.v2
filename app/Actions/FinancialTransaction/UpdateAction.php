<?php

namespace FinancialControl\Actions\FinancialTransaction;

use FinancialControl\Models\FinancialTransaction;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Custom\DTO\Response\FinancialTransactionResponse;

class UpdateAction extends AbstractAction
{
    public function run()
    {
        /** @var FinancialTransaction */
        $financialTransaction = FinancialTransaction::find($this->get('id'));

        if (empty($financialTransaction)) throw new NotFoundException();

        $financialTransaction->update($this->get('update_data'));

        return (new FinancialTransactionResponse($financialTransaction))->toArray();
    }
}