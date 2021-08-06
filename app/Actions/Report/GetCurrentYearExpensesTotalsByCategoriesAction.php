<?php

namespace FinancialControl\Actions\Report;

use Carbon\Carbon;
use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\FixedExpenseRepository;
use FinancialControl\Repositories\VariableExpenseRepository;

class GetCurrentYearExpensesTotalsByCategoriesAction extends AbstractAction
{
    private $variableExpenseRepository;
    private $fixedExpenseRepository;

    public function __construct(
        $data = [],
        VariableExpenseRepository $variableExpenseRepository,
        FixedExpenseRepository $fixedExpenseRepository
    ) {
        parent::__construct($data);

        $this->variableExpenseRepository = $variableExpenseRepository;
        $this->fixedExpenseRepository = $fixedExpenseRepository;
    }

    public function run()
    {

        return $this->logic();
        // @TODO: Criar lógica para construção da saída abaixo
        return [
            [
                'nonth' => 'january',
                'categories' => [
                    [
                        'name' => 'Nome categoria',
                        'total' => 1250.55
                    ]
                ]
            ],
            [
                'nonth' => 'february',
                'categories' => [
                    [
                        'name' => 'Nome categoria',
                        'total' => 1250.55
                    ],
                    [
                        'name' => 'Nome categoria',
                        'total' => 1250.55
                    ]
                ]
            ]
        ];
    }

    private function logic()
    {
        // @todo1: Refatorar lógica para utilizar algum DTO para construir a estrutura de dados
        // @todo2: Pensar numa forma para reaproveitar essa lógica de iteração por um período do ano
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
            $expirationDay = $lastDayOfMonth;

            $isCurrentMonth = $i === $currentMonth;
            if ($isCurrentMonth) {
                $periodEndDate = now()->format("Y-m-d");
                $expirationDay = now()->day;
            }

            $monthsTotals[] = [
                $date->monthName => 
                    (object) $this->fixedExpenseRepository->getTotalValueByCategory(
                        $periodStartDate,
                        $periodEndDate,
                        $expirationDay
                    )
            ];
        }

        return $monthsTotals;
    }

    private function getDateFromEngFormat(string $dateEnglishFormat): Carbon
    {
        return now()->createFromFormat('Y-m-d', $dateEnglishFormat);
    }
}
