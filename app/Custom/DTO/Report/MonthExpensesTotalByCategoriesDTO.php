<?php

namespace App\Custom\DTO\Report;

use Illuminate\Support\Collection;
use App\Custom\DTO\IDTO;

class MonthExpensesTotalByCategoriesDTO implements IDTO
{
    /** @var string */
    private $monthName;

    /** @var Collection */
    private $expensesTotalByCategory;

    public function __construct(string $monthName, Collection $expensesTotalByCategory)
    {
        $this->monthName = $monthName;
        $this->expensesTotalByCategory = $expensesTotalByCategory;
    }

    public function toArray(): array
    {
        return [
            'month'  => strtolower($this->monthName),
            'categories' => $this->getExpensesTotalByCategory(),
        ];
    }

    private function getExpensesTotalByCategory(): Collection
    {
        return $this->expensesTotalByCategory
                ->map(function (CategoryTotalDTO $categoryExpenseTotalDTO) {

                    return $categoryExpenseTotalDTO->toArray();
                })
                ->values();
    }
}