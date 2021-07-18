<?php

namespace FinancialControl\Repositories;

use FinancialControl\Models\Category;
use FinancialControl\Repositories\Base\Repository;

class CategoryRepository extends Repository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}