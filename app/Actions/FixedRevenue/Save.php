<?php

namespace FinancialControl\Actions\FixedRevenue;

use FinancialControl\Models\FixedRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\ActivationControl;

class Save extends AbstractAction
{
    public function run()
    {
        $activationControl = new ActivationControl($this->get('activation_control'));
        $activationControl->saveOrFail();

        $data = $this->data;
        unset($data['activation_control']);

        $fixedRevenueSaveData = array_merge($data, [ 'activation_control_id' => $activationControl->id ]);
        $fixedRevenue = new FixedRevenue($fixedRevenueSaveData);
        $fixedRevenue->saveOrFail();

        return $fixedRevenue->fresh();
    }
}