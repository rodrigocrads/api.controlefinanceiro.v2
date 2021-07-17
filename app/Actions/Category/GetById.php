<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\CategoryRepository;

class GetById extends AbstractAction
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
        return $this->categoryRepository->find($this->data['id']);
    }
}
