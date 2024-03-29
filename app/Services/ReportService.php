<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use App\Custom\DTO\Report\TotalsDTO;
use App\Custom\DTO\Report\MonthTotalsDTO;
use App\Repositories\Interfaces\IEntryRepository;

class ReportService
{
    private $repository;

    public function __construct(
        IEntryRepository $repository
    ) {
        $this->repository = $repository;
    }

    // @todo: mover logica de metodo para a Action (GetCurrentMonthTotals)
    public function getCurrentMonthTotals()
    {
        $periodStartDate = now()->format('Y-m') . "-1";
        $periodEndDate = now();

        return (new TotalsDTO(
            $this->repository->getTotalExpenses($periodStartDate, $periodEndDate),
            $this->repository->getTotalRevenues($periodStartDate, $periodEndDate),
        ))
        ->toArray();
    }

    // @todo: mover logica de metodo para a Action (GetCurrentYearTotalsAction)
    public function getCurrentYearTotals()
    {
        $startMonth = 1;
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $monthsTotals = [];

        for ($i = $startMonth; $i <= $currentMonth; $i++) {
            $periodStartDate = "{$currentYear}-{$i}-1";

            /** @var Carbon */
            $date = $this->getDateFromEngFormat($periodStartDate);

            $lastDayOfMonth = $date->format('t');
            $periodEndDate = "{$currentYear}-{$i}-{$lastDayOfMonth}";

            $isCurrentMonth = $i === $currentMonth;
            if ($isCurrentMonth) {
                $periodEndDate = now()->format("Y-m-d");
            }

            $monthsTotals[] =
                (new MonthTotalsDTO(
                    strtolower($date->monthName),
                    (new TotalsDTO(
                        $this->repository->getTotalExpenses($periodStartDate, $periodEndDate),
                        $this->repository->getTotalRevenues($periodStartDate, $periodEndDate),
                    ))
                ))->toArray();
        }

        return $monthsTotals;
    }

    private function getDateFromEngFormat(string $dateEnglishFormat): Carbon
    {
        return now()->createFromFormat('Y-m-d', $dateEnglishFormat);
    }
}