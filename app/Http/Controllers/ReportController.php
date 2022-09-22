<?php

namespace App\Http\Controllers;

use Throwable;
use App\Actions\Report\GetCurrentMonthTotals;
use App\Actions\Report\GetCurrentYearTotalsAction;
use App\Actions\Report\GetCurrentYearExpensesTotalsByCategoriesAction;
use App\Actions\Report\GetTotalExpenseByCategoryAction;
use App\Actions\Report\GetTotalRevenueByCategoryAction;
use App\Actions\Report\GetTotalsByMonthAction;

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

    public function getTotalsByMonth()
    {
        try {
            $action = resolve(GetTotalsByMonthAction::class, []);
            $result = $action->run();

            return response()->json($result ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getTotalExpenseByCategory()
    {
        try {
            $action = resolve(GetTotalExpenseByCategoryAction::class, []);
            $result = $action->run();

            return response()->json($result ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getTotalRevenueByCategory()
    {
        try {
            $action = resolve(GetTotalRevenueByCategoryAction::class, []);
            $result = $action->run();

            return response()->json($result ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }
}
