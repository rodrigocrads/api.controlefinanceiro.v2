<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Models\Category;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\CategoryRepository;

class ListAll extends AbstractAction
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(
        array $data = [],
        CategoryRepository $categoryRepository
    ) {
        parent::__construct($data);
        $this->categoryRepository = $categoryRepository;
    }

    public function run()
    {
        if ($this->hasFilterByType()) {
            return Category::where('type', '=', $this->get('params.type'))->get();
        }

        return $this->categoryRepository->all();
    }

    private function hasFilterByType(): bool
    {
        return !empty($this->get('params.type'));
    }
}
