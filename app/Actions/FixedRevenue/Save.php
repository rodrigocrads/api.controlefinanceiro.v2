<?php

namespace FinancialControl\Actions\FixedRevenue;

use FinancialControl\Models\FixedRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\FixedRevenueResponse;
use FinancialControl\Models\ActivationControl;

class Save extends AbstractAction
{
    public function run()
    {
        $fixedRevenue = new FixedRevenue($this->data);
        $fixedRevenue->saveOrFail();

        $activationControlSaveData = array_merge(
            $this->get('activation_control'),
            ['fixed_revenue_id' => $fixedRevenue->id],
        );
        $activationControl = new ActivationControl($activationControlSaveData);
        $activationControl->saveOrFail();

        return (new FixedRevenueResponse($fixedRevenue))->toArray();
    }
}