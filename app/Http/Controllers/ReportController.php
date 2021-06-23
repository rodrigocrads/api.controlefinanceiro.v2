<?php

namespace FinancialControl\Http\Controllers;

use Throwable;
use FinancialControl\Actions\Report\GetCurrentMonthTotals;

class ReportController extends Controller
{
    public function getCurrentMonthTotals()
    {
        try {
            $action = resolve(GetCurrentMonthTotals::class);
            $result = $action->run();

            return response()->json($result ?? []);

        } catch (Throwable $e) {
            dd($e->getMessage());
            return response()->json([], $e->getCode());
        }
    }
}
