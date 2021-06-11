<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Models\Category;
use FinancialControl\Actions\AbstractAction;

class GetById extends AbstractAction
{
    public function run()
    {
        return Category::find($this->data['id']);
    }
}