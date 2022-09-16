<?php

namespace App\Custom\DTO\Report;

use App\Custom\Interfaces\Arrayable;

class MonthTotalsDTO implements Arrayable
{
    /** @var string */
    private $monthName;

    /** @var TotalsDTO */
    private $totals;

    public function __construct(string $monthName,  TotalsDTO $totals)
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