<?php

namespace FinancialControl\Actions\VariableRevenue;

use Illuminate\Support\Collection;
use FinancialControl\Models\VariableRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\VariableRevenueRepository;

class ListAction extends AbstractAction
{
    private $repository;

    public function __construct(array $data = [], VariableRevenueRepository $repository)
    {
        parent::__construct($data);

        $this->repository = $repository;
    }

    public function run()
    {
        $variableRevenues = $this->repository->all($this->get('params'));

        if ($variableRevenues->isEmpty()) return [];

        return $this->buildResponse($variableRevenues);
    }

    private function buildResponse(Collection $variableRevenues): array
    {
        $variableRevenuesResponseData = array_map(function (VariableRevenue $variableRevenue) {

            return $variableRevenue->getDTO()->toArray();
        }, $variableRevenues->all());

        return $variableRevenuesResponseData;
    }
}