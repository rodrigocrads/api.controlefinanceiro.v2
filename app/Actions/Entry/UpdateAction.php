<?php

namespace App\Actions\Entry;

use App\Actions\AbstractAction;
use App\Models\Entry;
use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\IEntryRepository;

class UpdateAction extends AbstractAction
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
        $entry = $this->repository->update(
            $this->get('update_data'),
            $this->get('id')
        );

        if (empty($entry)) {
           throw new NotFoundException(); 
        }

        return $entry->getDTO()->toArray();
    }
}