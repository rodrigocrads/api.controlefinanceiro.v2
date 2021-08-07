<?php

namespace FinancialControl\Custom\DTO\Report;

use FinancialControl\Custom\DTO\IDTO;

class CategoryExpenseTotalDTO implements IDTO
{
    /** @var string */
    private $categoryName;

    /** @var float */
    private $total;

    public function __construct(string $categoryName, float $total)
    {
        $this->categoryName = $categoryName;
        $this->total = $total;
    }

    public function toArray(): array
    {
        return [
            'name'  => $this->categoryName,
            'total' => $this->total,
        ];
    }
}