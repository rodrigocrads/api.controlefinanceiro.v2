<?php

namespace App\Actions\Report;


use App\Actions\AbstractAction;
use App\Custom\DTO\Report\CategoryTotalDTO;
use App\Repositories\Interfaces\IFinancialTransactionRepository;
use Illuminate\Support\Collection;

class GetTotalRevenueByCategoryAction extends AbstractAction
{
    /**
     * @var IFinancialTransactionRepository
     */
    private $repository;

    public function __construct(
        $data = [],
        IFinancialTransactionRepository $financialTransaction
    ) {
        parent::__construct($data);

        $this->repository = $financialTransaction;
    }

    public function run()
    {
        $revenuesTotalByCategory = $this->getCollectionOfExpensesTotalByCategory(
            now()->format("01-m-Y"),
            now()->format("d-m-Y")
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
