<?php

namespace FinancialControl\Http\Controllers;

use Throwable;
use FinancialControl\Http\Requests\IdRequest;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Actions\VariableExpense\Save;
use FinancialControl\Actions\VariableExpense\GetById;
use FinancialControl\Actions\VariableExpense\Delete;
use FinancialControl\Actions\VariableExpense\Update;
use FinancialControl\Actions\VariableExpense\ListAll;
use FinancialControl\Http\Requests\VariableExpenseOrRevenue\SaveRequest;
use FinancialControl\Http\Requests\VariableExpenseOrRevenue\UpdateRequest;

class VariableExpenseController extends Controller
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

    public function listAll()
    {
        try {
            $action = resolve(ListAll::class);

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
            return response()->json([], $e->getCode());
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $action = resolve(Update::class, [
                'data' => [
                    'id' => $request->route('id'),
                    'update_data' => $request->all()
                ]
            ]);

            $fixedRevenue = $action->run();

            return response()->json($fixedRevenue);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function delete(IdRequest $request)
    {
        try {
            $action = resolve(Delete::class, [ 'data' => ['id' => $request->route('id') ]]);
            $action->run();

            return response()->json([]);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }
}
