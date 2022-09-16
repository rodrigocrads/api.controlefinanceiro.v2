<?php

namespace App\Actions\Report;

use Carbon\Carbon;
use App\Actions\AbstractAction;
use App\Custom\DTO\Report\MonthTotalsDTO;
use App\Custom\DTO\Report\TotalsDTO;
use App\Repositories\Interfaces\IFinancialTransactionRepository;

class GetTotalsByMonthAction extends AbstractAction
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

        $totals = [];
        while ($startDate->lt($endDate))
        {
            $year = $startDate->year;
            $month = $startDate->month;
            $periodStartDate = "{$year}-{$month}-01";

            $lastDayOfMonth = $startDate->format('t');
            $periodEndDate = "{$year}-{$month}-{$lastDayOfMonth}";

            $totals[$year][] =
                (new MonthTotalsDTO(
                    strtolower($startDate->monthName),
                    (new TotalsDTO(
                        $this->repository->getTotalExpenses($periodStartDate, $periodEndDate),
                        $this->repository->getTotalRevenues($periodStartDate, $periodEndDate),
                    ))
                ))->toArray();

            $startDate->addMonthWithNoOverflow(1);
        }

        return $totals;
    }

    private function getLastMonth(): Carbon
    {
        return now()->setDay("t");
    }
}
