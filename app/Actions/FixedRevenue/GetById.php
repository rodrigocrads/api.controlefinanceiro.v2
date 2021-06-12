<?php

namespace FinancialControl\Actions\FixedRevenue;

use FinancialControl\Models\FixedRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\FixedRevenueResponse;
use FinancialControl\Exceptions\NotFoundException;

class GetById extends AbstractAction
{
    public function run()
    {
        $fixedRevenue = FixedRevenue::find($this->data['id']);

        if ($fixedRevenue === null) throw new NotFoundException('Fixed revenue not found.');

        return (new FixedRevenueResponse($fixedRevenue))
            ->toArray();
    }
}