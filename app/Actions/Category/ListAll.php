<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Models\Category;
use FinancialControl\Actions\AbstractAction;

class ListAll extends AbstractAction
{
    public function run()
    {
        if ($this->hasFilterByType()) {
            return Category::where('type', '=', $this->get('params.type'))->get();
        }

        return Category::all();
    }

    private function hasFilterByType(): bool
    {
        return !empty($this->get('params.type'));
    }
}