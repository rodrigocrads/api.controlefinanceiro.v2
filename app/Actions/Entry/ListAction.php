<?php

namespace App\Actions\Entry;

use Illuminate\Support\Collection;
use App\Models\Entry;
use App\Actions\AbstractAction;
use App\Repositories\Interfaces\IEntryRepository;

class ListAction extends AbstractAction
{
    private $repository;

    public function __construct(array $data = [], IEntryRepository $repository)
    {
        parent::__construct($data);

        $this->repository = $repository;
    }

    public function run()
    {
        $entries = $this->repository->list($this->get('params', []));

        if ($entries->isEmpty()) return [];

        return $this->buildResponse($entries);
    }

    private function buildResponse(Collection $entriesCollect): array
    {
        return array_map(function (Entry $entry) {

            return $entry->getDTO()->toArray();
        }, $entriesCollect->all());
    }
}