<?php

namespace App\Actions\Report;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Actions\AbstractAction;
use App\Custom\DTO\Report\MonthExpensesTotalByCategoriesDTO;
use App\Repositories\Interfaces\IFinancialTransactionRepository;

class GetTotalExpenseByCategoryAndByMonthAction extends AbstractAction
{
    const NUMBER_OF_MONTHS = 12;

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
        /** @var Carbon */
        $startDate = now()
            ->subMonthWithoutOverflow(self::NUMBER_OF_MONTHS)
            ->setDay(1);

        /** @var Carbon */
        $endDate = $this->getLastMonth();

        $monthsTotals = [];
        while ($startDate->lt($endDate))
        {
            $year = $startDate->year;
            $month = $startDate->month;
            $monthStartDate = "{$year}-{$month}-01";

            $lastDayOfMonth = $startDate->format('t');
            $monthEndDate = "{$year}-{$month}-{$lastDayOfMonth}";

            $expensesTotalByCategory = $this->getCollectionOfExpensesTotalByCategory(
                $monthStartDate,
                $monthEndDate
            );

            $monthsTotals[] = (new MonthExpensesTotalByCategoriesDTO(
                $startDate->monthName,
                $expensesTotalByCategory
            ))->toArray();

            $startDate->addMonthWithNoOverflow(1);
        }

        return $monthsTotals;
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

    private function getLastMonth(): Carbon
    {
        return now()->setDay("t");
    }
}
