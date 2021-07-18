<?php

namespace FinancialControl\Actions\Report;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Services\ReportService;

class GetCurrentYearTotalsAction extends AbstractAction
{
    private $reportService;

    public function __construct(
        $data = [],
        ReportService $reportService
    ) {
        parent::__construct($data);

        $this->reportService = $reportService;
    }

    public function run()
    {
        return $this->reportService->getCurrentYearTotals();
    }
}