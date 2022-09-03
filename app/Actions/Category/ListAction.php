<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Actions\AbstractAction;
use App\Repositories\Impl\CategoryRepository;

class ListAction extends AbstractAction
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

        return $this->categoryRepository->list();
    }

    private function hasFilterByType(): bool
    {
        return !empty($this->get('params.type'));
    }
}
