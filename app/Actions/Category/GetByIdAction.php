<?php

namespace App\Actions\Category;

use App\Actions\AbstractAction;
use App\Repositories\Interfaces\ICategoryRepository;

class GetByIdAction extends AbstractAction
{
    /** @var ICategoryRepository */
    private $repository;

    public function __construct(
        array $data = [],
        ICategoryRepository $repository
    ) {
        parent::__construct($data);
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->find($this->data['id']);
    }
}
