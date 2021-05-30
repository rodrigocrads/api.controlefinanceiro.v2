<?php

namespace FinancialControl\Action\Category;

use FinancialControl\Models\Category;
use FinancialControl\Action\AbstractAction;

class GetById extends AbstractAction
{
    public function run()
    {
        return Category::find($this->data['id']);
    }
}