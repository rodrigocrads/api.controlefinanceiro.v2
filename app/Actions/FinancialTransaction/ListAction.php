<?php

namespace FinancialControl\Actions\FinancialTransaction;

use Illuminate\Support\Collection;
use FinancialControl\Models\FinancialTransaction;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\FinancialTransactionRepository;

class ListAction extends AbstractAction
{
    private $repository;

    public function __construct(array $data = [], FinancialTransactionRepository $repository)
    {
        parent::__construct($data);

        $this->repository = $repository;
    }

    public function run()
    {
        $financialTransactions = $this->repository->all($this->get('params', []));

        if ($financialTransactions->isEmpty()) return [];

        return $this->buildResponse($financialTransactions);
    }

    private function buildResponse(Collection $financialTransactions): array
    {
        $financialTransactionsResponseData = array_map(function (FinancialTransaction $financialTransaction) {

            return $financialTransaction->getDTO()->toArray();
        }, $financialTransactions->all());

        return $financialTransactionsResponseData;
    }
}