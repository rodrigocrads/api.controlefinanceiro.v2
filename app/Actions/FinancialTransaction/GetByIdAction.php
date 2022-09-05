<?php

namespace App\Actions\FinancialTransaction;

use App\Actions\AbstractAction;
use App\Models\FinancialTransaction;
use App\Repositories\Interfaces\IFinancialTransactionRepository;

class GetByIdAction extends AbstractAction
{
    /**
     * @var IFinancialTransactionRepository
     */
    private $repository;

    public function __construct(array $data = [], IFinancialTransactionRepository $repository)
    {
        parent::__construct($data);

        $this->repository = $repository;
    }

    public function run()
    {
        /** @var FinancialTransaction */
        $financialTransaction = $this->repository->find($this->data['id']);

        if ($financialTransaction === null) {
            return [];
        }

        return $financialTransaction->getDTO()->toArray();
    }
}