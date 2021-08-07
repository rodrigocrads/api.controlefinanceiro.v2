<?php

namespace FinancialControl\Actions\Report;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\FixedExpenseRepository;
use FinancialControl\Repositories\VariableExpenseRepository;
use FinancialControl\Custom\DTO\Report\CategoryExpenseTotalDTO;
use FinancialControl\Custom\DTO\Report\MonthExpensesTotalByCategoriesDTO;

class GetCurrentYearExpensesTotalsByCategoriesAction extends AbstractAction
{
    private $variableExpenseRepository;
    private $fixedExpenseRepository;

    public function __construct(
        $data = [],
        VariableExpenseRepository $variableExpenseRepository,
        FixedExpenseRepository $fixedExpenseRepository
    ) {
        parent::__construct($data);

        $this->variableExpenseRepository = $variableExpenseRepository;
        $this->fixedExpenseRepository = $fixedExpenseRepository;
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
            $expirationDay = $lastDayOfMonth;

            $isCurrentMonth = $i === $currentMonth;
            if ($isCurrentMonth) {
                $periodEndDate = now()->format("Y-m-d");
                $expirationDay = now()->day;
            }

            $expensesTotalByCategory = $this->getCollectionOfExpensesTotalByCategory(
                $periodStartDate,
                $periodEndDate,
                $expirationDay
            );

            $monthsTotals[] = (new MonthExpensesTotalByCategoriesDTO(
                $date->monthName,
                $expensesTotalByCategory
            ))->toArray();
        }

        return $monthsTotals;
    }

    private function getCollectionOfExpensesTotalByCategory($periodStartDate, $periodEndDate, $expirationDay): Collection
    {
        /** @var Collection */
        $variableExpensesTotalsByCategories = $this->variableExpenseRepository->getTotalValueByCategories(
            $periodStartDate,
            $periodEndDate
        );

        /** @var Collection */
        $fixedExpensesTotalsByCategories = $this->fixedExpenseRepository->getTotalValueByCategories(
            $periodStartDate,
            $periodEndDate,
            $expirationDay
        );

        $expensesTotalByCategory = collect();
        $expensesTotalByCategory = $this->addOrSumValueInTheTargetCollection(
            $variableExpensesTotalsByCategories,
            $expensesTotalByCategory
        );

        $expensesTotalByCategory = $this->addOrSumValueInTheTargetCollection(
            $fixedExpensesTotalsByCategories,
            $expensesTotalByCategory
        );

        return $expensesTotalByCategory->values();
    }

    private function addOrSumValueInTheTargetCollection(
        Collection $source,
        Collection $target
    ): Collection
    {
        $source->each(function (CategoryExpenseTotalDTO $categoryExpenseTotalDTO, $key) use ($target) {

            $foundCategoryExpenseTotalDTO = $target->get($key);

            if ($foundCategoryExpenseTotalDTO === null) {
                $target->put($key, $categoryExpenseTotalDTO);
                return;
            }

            $foundCategoryExpenseTotalDTO->total += $categoryExpenseTotalDTO->total;

            $target->put($key, $foundCategoryExpenseTotalDTO);
        });

        return $target;
    }

    private function getDateFromEngFormat(string $dateEnglishFormat): Carbon
    {
        return now()->createFromFormat('Y-m-d', $dateEnglishFormat);
    }
}
