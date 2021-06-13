<?php

namespace FinancialControl\Actions\FixedRevenue;

use Illuminate\Support\Collection;
use FinancialControl\Models\FixedRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\FixedExpenseOrRevenueResponse;

class ListAll extends AbstractAction
{
    public function run()
    {
        $fixedRevenues = FixedRevenue::all();

        if ($fixedRevenues->isEmpty()) {
            return [];
        }

        return $this->buildResponse($fixedRevenues);
    }

    private function buildResponse(Collection $fixedRevenues): array
    {
        $fixedRevenuesResponseData = array_map(function (FixedRevenue $fixedRevenue) {

            return (new FixedExpenseOrRevenueResponse($fixedRevenue))->toArray();
        }, $fixedRevenues->all());

        return $fixedRevenuesResponseData;
    }
}