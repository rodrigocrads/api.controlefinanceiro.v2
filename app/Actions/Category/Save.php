<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Action\AbstractAction;
use FinancialControl\Modelss\Category;

class Save extends AbstractAction
{
    public function run()
    {
        $category = new Category($this->data);
        $category->save();

        return $category->fresh();
    }
}