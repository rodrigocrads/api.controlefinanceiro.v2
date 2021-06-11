<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Models\Category;
use FinancialControl\Action\AbstractAction;

class ListAll extends AbstractAction
{
    public function run()
    {
        return Category::all();
    }
}