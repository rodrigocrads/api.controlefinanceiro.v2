<?php

namespace FinancialControl\Http\Controllers;

use Throwable;
use FinancialControl\Http\Requests\IdRequest;
use FinancialControl\Actions\FixedRevenue\Save;
use FinancialControl\Actions\FixedRevenue\GetById;
use FinancialControl\Actions\FixedRevenue\Delete;
use FinancialControl\Actions\FixedRevenue\Update;
use FinancialControl\Actions\FixedRevenue\ListAll;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Http\Requests\FixedExpenseOrRevenue\SaveRequest;
use FinancialControl\Http\Requests\FixedExpenseOrRevenue\UpdateRequest;
use Illuminate\Http\Request;

class FixedRevenueController extends Controller
{
    public function save(SaveRequest $request)
    {
        try {
            $action = resolve(Save::class, [
                'data' => $request->all()
            ]);

            return response()->json($action->run(), 201);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function listAll(Request $request)
    {
        try {
            $action = resolve(ListAll::class, [
                'data' => [
                    'params' => $request->query(),
                ]
            ]);

            $fixedRevenues = $action->run();

            return response()->json($fixedRevenues ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getById(IdRequest $request)
    {
        try {
            $action = resolve(GetById::class, ['data' => [ 'id' => $request->route('id') ]]);
            $fixedRevenue = $action->run();

            if (empty($fixedRevenue)) throw new NotFoundException();

            return response()->json($fixedRevenue);

        } catch (Throwable $e) {
            return response()->json("", $e->getCode());
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $action = resolve(Update::class, [
                'data' => [
                    'id' => $request->route('id'),
                    'fixed_revenue' => $request->all()
                ]
            ]);
            $fixedRevenue = $action->run();

            return response()->json($fixedRevenue);

        } catch (Throwable $e) {
            return response()->json("", $e->getCode());
        }
    }

    public function delete(IdRequest $request)
    {
        try {
            $action = resolve(Delete::class, [ 'data' => ['id' => $request->route('id') ]]);
            $action->run();

            return response()->json("");

        } catch (Throwable $e) {
            return response()->json("", $e->getCode());
        }
    }
}
