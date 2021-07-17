<?php

namespace FinancialControl\Services;

use FinancialControl\Custom\DTO\Report\TotalsDTO;
use FinancialControl\Repositories\FixedExpenseRepository;
use FinancialControl\Repositories\FixedRevenueRepository;
use FinancialControl\Repositories\VariableExpenseRepository;
use FinancialControl\Repositories\VariableRevenueRepository;

class ReportService
{
    private $variableExpenseRepository;
    private $variableRevenueRepository;
    private $fixedRevenueRepository;
    private $fixedExpenseRepository;

    public function __construct(
        VariableExpenseRepository $variableExpenseRepository,
        VariableRevenueRepository $variableRevenueRepository,
        FixedRevenueRepository $fixedRevenueRepository,
        FixedExpenseRepository $fixedExpenseRepository
    ) {
        $this->variableExpenseRepository = $variableExpenseRepository;
        $this->variableRevenueRepository = $variableRevenueRepository;
        $this->fixedRevenueRepository = $fixedRevenueRepository;
        $this->fixedExpenseRepository = $fixedExpenseRepository;
    }

    public function getCurrentMonthTotals()
    {
        $startDatePeriod = "01/" . now()->format('m/Y');
        $endDatePeriod = now();

        return (new TotalsDTO(
            $this->fixedExpenseRepository->getTotalValue($startDatePeriod, $endDatePeriod),
            $this->fixedRevenueRepository->getTotalValue($startDatePeriod, $endDatePeriod),
            $this->variableExpenseRepository->getTotalValue($startDatePeriod, $endDatePeriod),
            $this->variableRevenueRepository->getTotalValue($startDatePeriod, $endDatePeriod),
        ))
        ->toArray();
    }
}