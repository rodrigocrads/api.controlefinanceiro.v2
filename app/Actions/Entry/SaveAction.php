<?php

namespace App\Actions\Entry;

use App\Actions\AbstractAction;
use App\Models\Entry;
use App\Repositories\Interfaces\IEntryRepository;

class SaveAction extends AbstractAction
{
    /**
     * @var IEntryRepository
     */
    private $repository;

    public function __construct(array $data = [], IEntryRepository $repository)
    {
        parent::__construct($data);

        $this->repository = $repository;
    }

    public function run()
    {
        /** @var Entry */
        $entry = $this->repository->create($this->getAll());

        return $entry->getDTO()->toArray();
    }
}