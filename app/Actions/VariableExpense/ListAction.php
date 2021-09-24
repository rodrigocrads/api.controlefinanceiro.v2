<?php

namespace FinancialControl\Actions\VariableExpense;

use Illuminate\Support\Collection;
use FinancialControl\Models\VariableExpense;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\VariableExpenseRepository;
use FinancialControl\Custom\DTO\Response\VariableExpenseOrRevenueResponse;

class ListAction extends AbstractAction
{
    private $repository;

    public function __construct(array $data = [], VariableExpenseRepository $repository)
    {
        parent::__construct($data);

        $this->repository = $repository;
    }

    public function run()
    {
        $variableExpenses = $this->repository->all($this->get('params', []));

        if ($variableExpenses->isEmpty()) return [];

        return $this->buildResponse($variableExpenses);
    }

    private function buildResponse(Collection $variableExpenses): array
    {
        $variableExpensesResponseData = array_map(function (VariableExpense $variableExpense) {

            return $variableExpense->getDTO()->toArray();
        }, $variableExpenses->all());

        return $variableExpensesResponseData;
    }
}