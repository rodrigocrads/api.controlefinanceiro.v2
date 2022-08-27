<?php

namespace App\Custom\DTO\Report;

use App\Custom\DTO\IDTO;

class CategoryTotalDTO implements IDTO
{
    /** @var string */
    public $categoryName;

    /** @var float */
    public $total;

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