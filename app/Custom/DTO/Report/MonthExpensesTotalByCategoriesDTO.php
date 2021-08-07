<?php

namespace FinancialControl\Custom\DTO\Report;

use Illuminate\Support\Collection;
use FinancialControl\Custom\DTO\IDTO;

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
            'name'  => strtolower($this->monthName),
            'categories' => $this->getExpensesTotalByCategory(),
        ];
    }

    private function getExpensesTotalByCategory(): Collection
    {
        return $this->expensesTotalByCategory
                ->map(function (CategoryExpenseTotalDTO $categoryExpenseTotalDTO) {

                    return $categoryExpenseTotalDTO->toArray();
                })
                ->values();
    }
}