<?php

namespace App\Actions\Report;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Actions\AbstractAction;
use App\Custom\DTO\Report\MonthExpensesTotalByCategoriesDTO;
use App\Repositories\Interfaces\IFinancialTransactionRepository;

class GetCurrentYearExpensesTotalsByCategoriesAction extends AbstractAction
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
        // @todo: Pensar numa forma para reaproveitar essa lógica de iteração por um período do ano
        $startMonth = 1;
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $monthsTotals = [];
        for ($i = $startMonth; $i <= $currentMonth; $i++) {
            $periodStartDate = "{$currentYear}-{$i}-1";

            /** @var Carbon */
            $date = $this->getDateFromEngFormat($periodStartDate);

            $lastDayOfMonth = $date->format('t');
            $periodEndDate = "{$currentYear}-{$i}-{$lastDayOfMonth}";

            $isCurrentMonth = $i === $currentMonth;
            if ($isCurrentMonth) {
                $periodEndDate = now()->format("Y-m-d");
            }

            $expensesTotalByCategory = $this->getCollectionOfExpensesTotalByCategory(
                $periodStartDate,
                $periodEndDate
            );

            $monthsTotals[] = (new MonthExpensesTotalByCategoriesDTO(
                $date->monthName,
                $expensesTotalByCategory
            ))->toArray();
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

    private function getDateFromEngFormat(string $dateEnglishFormat): Carbon
    {
        return now()->createFromFormat('Y-m-d', $dateEnglishFormat);
    }
}
