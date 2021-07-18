<?php

namespace FinancialControl\Http\Controllers;

use Throwable;
use FinancialControl\Actions\Report\GetCurrentMonthTotals;
use FinancialControl\Actions\Report\GetCurrentYearTotalsAction;

class ReportController extends Controller
{
    public function getCurrentMonthTotals()
    {
        try {
            $action = resolve(GetCurrentMonthTotals::class);
            $result = $action->run();

            return response()->json($result ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getCurrentYearTotals()
    {
        try {
            $action = resolve(GetCurrentYearTotalsAction::class);
            $result = $action->run();

            return response()->json($result ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }
}
