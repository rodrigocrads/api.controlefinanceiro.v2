<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Models\Category;
use FinancialControl\Actions\AbstractAction;

class Save extends AbstractAction
{
    public function run()
    {
        $category = new Category($this->data);
        $category->save();

        return $category->fresh();
    }
}