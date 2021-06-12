<?php

namespace FinancialControl\Actions\FixedRevenue;

use FinancialControl\Models\FixedRevenue;
use FinancialControl\Actions\AbstractAction;

class Delete extends AbstractAction
{
    public function run()
    {
        /** @var FixedRevenue */
        $fixedRevenue = FixedRevenue::find($this->data['id']);
        $fixedRevenue->delete();
    }
}