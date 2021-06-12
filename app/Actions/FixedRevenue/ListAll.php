<?php

namespace FinancialControl\Actions\FixedRevenue;

use FinancialControl\Models\FixedRevenue;
use FinancialControl\Actions\AbstractAction;

class ListAll extends AbstractAction
{
    public function run()
    {
        return FixedRevenue::all();
    }
}