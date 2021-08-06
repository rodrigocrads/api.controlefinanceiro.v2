<?php

namespace FinancialControl\Actions\Report;

use Carbon\Carbon;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Custom\DTO\Report\CategoryTotalDTO;
use FinancialControl\Repositories\FixedExpenseRepository;
use FinancialControl\Repositories\VariableExpenseRepository;
use Illuminate\Support\Collection;
use Throwable;

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
        // @todo 1: Refatorar lógica para utilizar algum DTO para construir a estrutura de dados
        // @todo 2: Pensar numa forma para reaproveitar essa lógica de iteração por um período do ano
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

            /** @var Collection */
            $variableExpensesTotalsByCategories = $this->variableExpenseRepository->getTotalValueByCategories($periodStartDate, $periodEndDate);

            /** @var Collection */
            $fixedExpensesTotalsByCategories = $this->fixedExpenseRepository->getTotalValueByCategories($periodStartDate, $periodEndDate, $expirationDay);

            $expensesTotalsByCategories = collect();
            $expensesTotalsByCategories = $this->addOrSumValueInTheTargetCollection(
                $variableExpensesTotalsByCategories,
                $expensesTotalsByCategories
            );

            $expensesTotalsByCategories = $this->addOrSumValueInTheTargetCollection(
                $fixedExpensesTotalsByCategories,
                $expensesTotalsByCategories
            );

            $monthsTotals[] = [
                $date->monthName => $expensesTotalsByCategories->map(function ($value, $key) {

                    return (new CategoryTotalDTO($key, $value))->toArray();
                })->values()
            ];
        }

        return $monthsTotals;
    }

    private function addOrSumValueInTheTargetCollection(
        Collection $source,
        Collection $target
    ): Collection
    {
        $source->each(function ($value, $key) use ($target) {

            $foundValue = $target->get($key);

            if ($foundValue === null) {
                $target->put($key, $value);
                return;
            }

            $target->put($key, $foundValue + $value);
        });

        return $target;
    }

    private function getDateFromEngFormat(string $dateEnglishFormat): Carbon
    {
        return now()->createFromFormat('Y-m-d', $dateEnglishFormat);
    }
}
