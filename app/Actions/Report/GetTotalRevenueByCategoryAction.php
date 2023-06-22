<?php

namespace App\Actions\Report;


use App\Actions\AbstractAction;
use App\Custom\DTO\Report\CategoryTotalDTO;
use App\Repositories\Interfaces\IEntryRepository;
use Illuminate\Support\Collection;

class GetTotalRevenueByCategoryAction extends AbstractAction
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
        $revenuesTotalByCategory = $this->getCollectionOfExpensesTotalByCategory(
            now()->format("Y-m-01"),
            now()->format("Y-m-d")
        );

        return $revenuesTotalByCategory
            ->map(function (CategoryTotalDTO $categoryRevenueTotalDTO) {

                return $categoryRevenueTotalDTO->toArray();
            })
            ->values();
    }

    private function getCollectionOfExpensesTotalByCategory($periodStartDate, $periodEndDate): Collection
    {
        /** @var Collection */
        $totalByCategory = $this->repository->getTotalByCategory(
            'revenue',
            $periodStartDate,
            $periodEndDate
        );

        return $totalByCategory->values();
    }
}
