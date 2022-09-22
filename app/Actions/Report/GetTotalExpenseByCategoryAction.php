<?php

namespace App\Actions\Report;


use App\Actions\AbstractAction;
use App\Custom\DTO\Report\CategoryTotalDTO;
use App\Repositories\Interfaces\IFinancialTransactionRepository;
use Illuminate\Support\Collection;

class GetTotalExpenseByCategoryAction extends AbstractAction
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
        $expensesTotalByCategory = $this->getCollectionOfExpensesTotalByCategory(
            now()->format("01-m-Y"),
            now()->format("d-m-Y")
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
