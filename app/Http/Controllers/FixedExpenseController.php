<?php

namespace FinancialControl\Http\Controllers;

use Throwable;
use FinancialControl\Http\Requests\IdRequest;
use FinancialControl\Actions\FixedExpense\Save;
use FinancialControl\Actions\FixedExpense\Delete;
use FinancialControl\Actions\FixedExpense\Update;
use FinancialControl\Actions\FixedExpense\ListAll;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Actions\FixedExpense\GetById;
use FinancialControl\Http\Requests\FixedExpenseOrRevenue\SaveRequest;
use FinancialControl\Http\Requests\FixedExpenseOrRevenue\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FixedExpenseController extends Controller
{
    public function save(SaveRequest $request)
    {
        try {
            $action = resolve(Save::class, [
                'data' => array_merge(
                    $request->all(),
                    [ 'user_id' => Auth::user()->id ]
                )
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

            $fixedExpenses = $action->run();

            return response()->json($fixedExpenses ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getById(IdRequest $request)
    {
        try {
            $action = resolve(GetById::class, ['data' => [ 'id' => $request->route('id') ]]);
            $fixedExpense = $action->run();

            if (empty($fixedExpense)) throw new NotFoundException();

            return response()->json($fixedExpense);

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
                    'fixed_expense' => array_merge(
                        $request->all(),
                        [ 'user_id' => Auth::user()->id ]
                    )
                ]
            ]);
            $fixedExpense = $action->run();

            return response()->json($fixedExpense);

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
