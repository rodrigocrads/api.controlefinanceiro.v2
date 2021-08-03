<?php

namespace FinancialControl\Actions\Report;

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
}
