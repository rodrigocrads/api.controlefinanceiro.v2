<?php

namespace FinancialControl\Actions\FixedRevenue;

use FinancialControl\Models\FixedRevenue;
use FinancialControl\Actions\AbstractAction;

class GetById extends AbstractAction
{
    public function run()
    {
        return FixedRevenue::find($this->data['id']);
    }
}