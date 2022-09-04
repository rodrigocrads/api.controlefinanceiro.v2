<?php

namespace App\Actions\FinancialTransaction;

use Illuminate\Support\Collection;
use App\Models\FinancialTransaction;
use App\Actions\AbstractAction;
use App\Repositories\Interfaces\IFinancialTransactionRepository;

class ListAction extends AbstractAction
{
    private $repository;

    public function __construct(array $data = [], IFinancialTransactionRepository $repository)
    {
        parent::__construct($data);

        $this->repository = $repository;
    }

    public function run()
    {
        $financialTransactions = $this->repository->list($this->get('params', []));

        if ($financialTransactions->isEmpty()) return [];

        return $this->buildResponse($financialTransactions);
    }

    private function buildResponse(Collection $financialTransactionsCollect): array
    {
        return array_map(function (FinancialTransaction $financialTransaction) {

            return $financialTransaction->getDTO()->toArray();
        }, $financialTransactionsCollect->all());
    }
}