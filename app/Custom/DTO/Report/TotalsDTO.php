<?php

namespace FinancialControl\Custom\DTO\Report;

use FinancialControl\Custom\DTO\IDTO;

class TotalsDTO implements IDTO
{
    private $fixedExpenseTotal;
    private $fixedRevenueTotal;
    private $variableExpensesTotal;
    private $variableRevenueTotal;

    public function __construct(
        float $fixedExpenseTotal,
        float $fixedRevenueTotal,
        float $variableExpensesTotal,
        float $variableRevenueTotal
    ) {
        $this->fixedExpenseTotal = $fixedExpenseTotal;
        $this->fixedRevenueTotal = $fixedRevenueTotal;
        $this->variableExpensesTotal = $variableExpensesTotal;
        $this->$variableRevenueTotal = $variableRevenueTotal;
    }

    public function toArray(): array
    {
        return [
            'fixedExpenseTotal'     => $this->fixedExpenseTotal ?? 0,
            'fixedRevenueTotal'     => $this->fixedRevenueTotal ?? 0,
            'variableExpenseTotal'  => $this->variableExpensesTotal ?? 0,
            'variableRevenueTotal'  => $this->variableRevenueTotal ?? 0,
        ];
    }
}