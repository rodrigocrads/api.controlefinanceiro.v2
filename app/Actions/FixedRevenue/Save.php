<?php

namespace FinancialControl\Actions\FixedRevenue;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\ActivationControl;
use FinancialControl\Models\FixedRevenue;

class Save extends AbstractAction
{
    public function run()
    {
        $activationControl = new ActivationControl($this->get('activation_control'));
        $activationControl->save();

        $data = $this->data;
        unset($data['activation_control']);

        $fixedRevenueSaveData = array_merge($data, [ 'activation_control_id' => $activationControl->id ]);
        $fixedRevenue = new FixedRevenue($fixedRevenueSaveData);
        $fixedRevenue->save();

        return $fixedRevenue->fresh();
    }
}