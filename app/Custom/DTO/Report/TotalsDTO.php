<?php

namespace FinancialControl\Custom\DTO\Report;

use FinancialControl\Custom\DTO\IDTO;

class TotalsDTO implements IDTO
{
    private $totalFixedExpense;
    private $totalFixedRevenue;
    private $totalVariableExpense;
    private $totalVariableRevenue;

    public function __construct(
        float $totalFixedExpense,
        float $totalFixedRevenue,
        float $totalVariableExpense,
        float $totalVariableRevenue
    ) {
        $this->totalFixedExpense = $totalFixedExpense;
        $this->totalFixedRevenue = $totalFixedRevenue;
        $this->totalVariableExpense = $totalVariableExpense;
        $this->$totalVariableRevenue = $totalVariableRevenue;
    }

    public function toArray(): array
    {
        return [
            'totalFixedExpense'     => $this->totalFixedExpense ?? 0,
            'totalFixedRevenue'     => $this->totalFixedRevenue ?? 0,
            'totalVariableExpense'  => $this->totalVariableExpense ?? 0,
            'totalVariableRevenue'  => $this->totalVariableRevenue ?? 0,
        ];
    }
}