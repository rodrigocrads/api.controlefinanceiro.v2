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

class FixedExpenseController extends Controller
{
    public function save(SaveRequest $request)
    {
        try {
            $action = resolve(Save::class, [
                'data' => [
                    'title' => $request->get('title'),
                    'description' => $request->get('description'),
                    'value' => $request->get('value'),
                    'category_id' => $request->get('category_id'),
                    'activation_control' => $request->get('activation_control'),
                ]
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
                    'fixed_expense' => [
                        'title' => $request->get('title'),
                        'description' => $request->get('description'),
                        'value' => $request->get('value'),
                        'category_id' => $request->get('category_id'),
                        'activation_control' => $request->get('activation_control'),
                    ]
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
