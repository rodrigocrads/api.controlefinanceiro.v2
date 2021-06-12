<?php

namespace FinancialControl\Actions\FixedRevenue;

use FinancialControl\Models\FixedRevenue;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\ActivationControl;
use FinancialControl\Exceptions\NotFoundException;

class Update extends AbstractAction
{
    public function run()
    {
        /** @var FixedRevenue */
        $fixedRevenue = FixedRevenue::find($this->get('id'));

        if (empty($fixedRevenue)) throw new NotFoundException('Fixed revenue not found!');

        /** @var ActivationControl */
        $activationControl = ActivationControl::find($fixedRevenue->id);

        if (empty($activationControl)) throw new NotFoundException('Activation control not found!');

        $activationControl->update($this->get('fixed_revenue.activation_control'));

        $fixedRevenue->update($this->get('fixed_revenue'));

        return $fixedRevenue->fresh();
    }
}