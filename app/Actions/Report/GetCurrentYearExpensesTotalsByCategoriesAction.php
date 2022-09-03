<?php

namespace App\Actions\Report;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Actions\AbstractAction;
use App\Repositories\Impl\FinancialTransactionRepository;
use App\Custom\DTO\Report\CategoryTotalDTO;
use App\Custom\DTO\Report\MonthExpensesTotalByCategoriesDTO;

class GetCurrentYearExpensesTotalsByCategoriesAction extends AbstractAction
{
    private $financialTransaction;

    public function __construct(
        $data = [],
        FinancialTransactionRepository $financialTransaction
    ) {
        parent::__construct($data);

        $this->financialTransaction = $financialTransaction;
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
        $expensesTotalsByCategories = $this->financialTransaction->getTotalExpensesByCategories(
            $periodStartDate,
            $periodEndDate
        );

        $expensesTotalByCategory = collect();
        $expensesTotalByCategory = $this->addOrSumValueInTheTargetCollection(
            $expensesTotalsByCategories,
            $expensesTotalByCategory
        );

        return $expensesTotalByCategory->values();
    }

    private function addOrSumValueInTheTargetCollection(
        Collection $source,
        Collection $target
    ): Collection
    {
        $source->each(function (CategoryTotalDTO $categoryExpenseTotalDTO, $key) use ($target) {

            $foundCategoryTotalDTO = $target->get($key);

            if ($foundCategoryTotalDTO === null) {
                $target->put($key, $categoryExpenseTotalDTO);
                return;
            }

            $foundCategoryTotalDTO->total += $categoryExpenseTotalDTO->total;

            $target->put($key, $foundCategoryTotalDTO);
        });

        return $target;
    }

    private function getDateFromEngFormat(string $dateEnglishFormat): Carbon
    {
        return now()->createFromFormat('Y-m-d', $dateEnglishFormat);
    }
}
