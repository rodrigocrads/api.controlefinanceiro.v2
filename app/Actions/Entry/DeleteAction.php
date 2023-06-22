<?php

namespace App\Actions\Entry;

use App\Actions\AbstractAction;
use App\Repositories\Interfaces\IEntryRepository;

class DeleteAction extends AbstractAction
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
        $this->repository->delete($this->data['id']);
    }
}