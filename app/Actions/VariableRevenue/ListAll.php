<?php

namespace FinancialControl\Actions\VariableRevenue;

use Illuminate\Support\Collection;
use FinancialControl\Models\VariableRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\VariableExpenseOrRevenue;

class ListAll extends AbstractAction
{
    public function run()
    {
        $variableRevenues = VariableRevenue::all();

        if ($variableRevenues->isEmpty()) return [];

        return $this->buildResponse($variableRevenues);
    }

    private function buildResponse(Collection $variableRevenues): array
    {
        $variableRevenuesResponseData = array_map(function (VariableRevenue $VariableRevenue) {

            return (new VariableExpenseOrRevenue($VariableRevenue))->toArray();
        }, $variableRevenues->all());

        return $variableRevenuesResponseData;
    }
}