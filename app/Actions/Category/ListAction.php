<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Actions\AbstractAction;
use App\Repositories\Interfaces\ICategoryRepository;

class ListAction extends AbstractAction
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
        if ($this->hasFilterByType()) {
            return Category::where('type', '=', $this->get('params.type'))->get();
        }

        return $this->repository->list();
    }

    private function hasFilterByType(): bool
    {
        return !empty($this->get('params.type'));
    }
}
