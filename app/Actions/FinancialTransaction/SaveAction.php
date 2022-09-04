<?php

namespace App\Actions\FinancialTransaction;

use App\Actions\AbstractAction;
use App\Models\FinancialTransaction;
use App\Repositories\Interfaces\IFinancialTransactionRepository;

class SaveAction extends AbstractAction
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
        $financialTransaction = $this->repository->create($this->getAll());

        return $financialTransaction->getDTO()->toArray();
    }
}