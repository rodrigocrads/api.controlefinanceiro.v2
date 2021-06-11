<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Models\Category;
use FinancialControl\Actions\AbstractAction;

class Update extends AbstractAction
{
    public function run()
    {
        /** @var Category */
        $category = Category::find($this->data['id']);
        $category->update($this->data['data']);

        return $category->fresh();
    }
}