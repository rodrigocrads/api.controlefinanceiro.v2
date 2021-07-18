<?php

namespace FinancialControl\Actions\Category;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\CategoryRepository;

class Update extends AbstractAction
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
        return $this->categoryRepository->update(
            $this->data['data'],
            $this->data['id']
        );
    }
}
