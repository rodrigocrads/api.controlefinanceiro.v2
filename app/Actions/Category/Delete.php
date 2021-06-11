<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Models\Category;
use FinancialControl\Action\AbstractAction;

class Delete extends AbstractAction
{
    public function run()
    {
        /** @var Category */
        $category = Category::find($this->data['id']);
        $category->delete();
    }
}