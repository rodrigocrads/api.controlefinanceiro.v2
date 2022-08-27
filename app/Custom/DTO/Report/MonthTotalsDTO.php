<?php

namespace App\Custom\DTO\Report;

use App\Custom\DTO\IDTO;

class MonthTotalsDTO implements IDTO
{
    /** @var string */
    private $monthName;

    /** @var TotalsDTO */
    private $totals;

    public function __construct(string $monthName, TotalsDTO $totals)
    {
        $this->monthName = $monthName;
        $this->totals = $totals;
    }

    public function toArray(): array
    {
        return [
            'month'  => $this->monthName,
            'totals' => $this->totals->toArray(),
        ];
    }
}