<?php

namespace App\Actions\Report;


use App\Actions\AbstractAction;
use App\Custom\DTO\Report\CategoryTotalDTO;
use App\Repositories\Interfaces\IEntryRepository;
use Illuminate\Support\Collection;

class GetTotalExpenseByCategoryAction extends AbstractAction
{
    /**
     * @var IEntryRepository
     */
    private $repository;

    public function __construct(
        $data = [],
        IEntryRepository $entry
    ) {
        parent::__construct($data);

        $this->repository = $entry;
    }

    public function run()
    {
        $expensesTotalByCategory = $this->getCollectionOfExpensesTotalByCategory(
            now()->format("Y-m-01"),
            now()->format("Y-m-d")
        );

        return $expensesTotalByCategory
            ->map(function (CategoryTotalDTO $categoryExpenseTotalDTO) {

                return $categoryExpenseTotalDTO->toArray();
            })
            ->values();
    }

    private function getCollectionOfExpensesTotalByCategory($periodStartDate, $periodEndDate): Collection
    {
        /** @var Collection */
        $totalByCategory = $this->repository->getTotalByCategory(
            'expense',
            $periodStartDate,
            $periodEndDate
        );

        return $totalByCategory->values();
    }
}
