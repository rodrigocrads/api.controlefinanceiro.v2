<?php

namespace App\Actions\Report;

use App\Actions\AbstractAction;
use App\Services\ReportService;

class GetCurrentMonthTotals extends AbstractAction
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
        return $this->reportService->getCurrentMonthTotals();
    }
}