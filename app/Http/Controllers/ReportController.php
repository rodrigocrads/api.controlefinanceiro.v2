<?php

namespace App\Http\Controllers;

use Throwable;
use App\Actions\Report\GetCurrentMonthTotals;
use App\Actions\Report\GetCurrentYearTotalsAction;
use App\Actions\Report\GetCurrentYearExpensesTotalsByCategoriesAction;
use App\Actions\Report\GetLastMonthsTotalsAction;

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

    public function getCurrentYearExpensesTotalsByCategories()
    {
        try {
            $action = resolve(GetCurrentYearExpensesTotalsByCategoriesAction::class);
            $result = $action->run();

            return response()->json($result ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getLastMonthsTotals($numberOfMonths)
    {
        try {
            $action = resolve(GetLastMonthsTotalsAction::class, [
                'data' => [
                    'numberOfMonths' => $numberOfMonths,
                ]
            ]);
            $result = $action->run();

            return response()->json($result ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }
}
