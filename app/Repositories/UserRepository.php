<?php

namespace FinancialControl\Repositories;

use FinancialControl\User;
use FinancialControl\Repositories\Base\Repository;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}