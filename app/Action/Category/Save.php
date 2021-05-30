<?php

namespace FinancialControl\Action\Category;

use FinancialControl\Action\AbstractAction;
use FinancialControl\Models\Category;

class Save extends AbstractAction
{
    public function run()
    {
        $category = new Category($this->data);
        $category->save();

        return $category->fresh();
    }
}