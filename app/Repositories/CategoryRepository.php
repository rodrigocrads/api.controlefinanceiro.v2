<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Base\Repository;

class CategoryRepository extends Repository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}