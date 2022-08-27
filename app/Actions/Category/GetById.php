<?php

namespace App\Actions\Category;

use App\Actions\AbstractAction;
use App\Repositories\CategoryRepository;

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
