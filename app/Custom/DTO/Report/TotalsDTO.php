<?php

namespace App\Custom\DTO\Report;

use App\Custom\DTO\IDTO;

class TotalsDTO implements IDTO
{
    private $totalExpense;
    private $totalRevenue;

    public function __construct(
        float $totalExpense,
        float $totalRevenue
    ) {
        $this->totalExpense = $totalExpense;
        $this->totalRevenue = $totalRevenue;
    }

    public function toArray(): array
    {
        return [
            'expense'  => $this->totalExpense ?? 0,
            'revenue'  => $this->totalRevenue ?? 0,
        ];
    }
}