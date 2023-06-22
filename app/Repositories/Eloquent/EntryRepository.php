<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Collection;
use App\Models\Entry;
use App\Custom\DTO\Report\CategoryTotalDTO;
use App\Repositories\Interfaces\IEntryRepository;

class EntryRepository extends BaseRepository implements IEntryRepository
{
    public function __construct(Entry $model)
    {
        parent::__construct($model);
    }

    public function getTotalExpenses(string $startDate, string $endDate): float
    {
        return $this->listByPeriod($startDate, $endDate)
            ->filter(function (Entry $item) {

                return $item->type === 'expense';
             })
            ->sum('value');
    }

    public function getTotalRevenues(string $startDate, string $endDate): float
    {
        return $this->listByPeriod($startDate, $endDate)
            ->filter(function (Entry $item) {

                return $item->type === 'revenue';
            })
            ->sum('value');
    }

    public function listByPeriod(string $startDate, string $endDate): Collection
    {
        return Entry::whereBetween(
                'register_date',
                [ $startDate, $endDate ]
            )
            ->get();
    }

    public function getTotalByCategory(string $type, string $startDate, string $endDate): Collection
    {
        return Entry::whereBetween(
                'register_date',
                [ $startDate, $endDate ]
            )
            ->where('type', $type)
            ->get()
            ->groupBy('category.name')
            ->map(function (Collection $entries, $categoryName) {
                $total = $entries->sum('value');

                return new CategoryTotalDTO(
                    $categoryName,
                    $total
                );
            });
    }
}