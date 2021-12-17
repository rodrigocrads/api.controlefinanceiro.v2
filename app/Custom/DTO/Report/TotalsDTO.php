<?php

namespace FinancialControl\Custom\DTO\Report;

use FinancialControl\Custom\DTO\IDTO;

class TotalsDTO implements IDTO
{
    private $totalVariableExpense;
    private $totalVariableRevenue;

    public function __construct(
        float $totalVariableExpense,
        float $totalVariableRevenue
    ) {
        $this->totalVariableExpense = $totalVariableExpense;
        $this->totalVariableRevenue = $totalVariableRevenue;
    }

    public function toArray(): array
    {
        return [
            'totalVariableExpense'  => $this->totalVariableExpense ?? 0,
            'totalVariableRevenue'  => $this->totalVariableRevenue ?? 0,
        ];
    }
}