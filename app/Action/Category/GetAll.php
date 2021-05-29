<?php

namespace FinancialControl\Action\Category;

use FinancialControl\Models\Category;
use FinancialControl\Action\AbstractAction;

class GetAll extends AbstractAction
{
    public function run()
    {
        return Category::all();
    }
}