<?php

namespace FinancialControl\Actions\Report;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Models\FixedExpense;
use FinancialControl\Models\FixedRevenue;
use FinancialControl\Models\VariableExpense;
use FinancialControl\Models\VariableRevenue;

class GetCurrentMonthTotals extends AbstractAction
{
    public function run()
    {
        return [
            'fixedExpenseTotal'     => $this->getFixedExpenseTotal(),
            'fixedRevenueTotal'     => $this->getFixedRevenueTotal(),
            'variableExpenseTotal'  => $this->getVariableExpensesTotal(),
            'variableRevenueTotal'  => $this->getVariableRevenueTotal(),
        ];
    }

    private function getVariableExpensesTotal(): float
    {
        return VariableExpense::whereBetween(
                'register_date',
                [ $this->getStartDate(), $this->getEndDate() ]
            )
            ->get()
            ->sum('value');
    }

    private function getVariableRevenueTotal(): float
    {
        return VariableRevenue::whereBetween(
                'register_date',
                [ $this->getStartDate(), $this->getEndDate() ]
            )
            ->get()
            ->sum('value');
    }

    // @todo: retornar do banco já filtrado
    private function getFixedRevenueTotal(): float
    {
        return FixedRevenue::all()
            ->filter(function (FixedRevenue $fixedRevenue) {

                return $fixedRevenue->isActive() && $fixedRevenue->hasExpiredDay();
            })
            ->sum('value');
    }

    // @todo: retornar do banco já filtrado
    private function getFixedExpenseTotal(): float
    {
       return FixedExpense::all()
            ->filter(function (FixedExpense $fixedExpense) {

                return $fixedExpense->isActive() && $fixedExpense->hasExpiredDay();
            })
            ->sum('value');
    }

    private function getStartDate(): string
    {
        return "01/" . now()->format('m/Y');
    }

    private function getEndDate(): string
    {
        return now()->format('t/m/Y');
    }
}