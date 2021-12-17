<?php

namespace FinancialControl\Http\Controllers;

use Throwable;
use FinancialControl\Http\Requests\IdRequest;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Actions\VariableRevenue\Save;
use FinancialControl\Actions\VariableRevenue\GetById;
use FinancialControl\Actions\VariableRevenue\Delete;
use FinancialControl\Actions\VariableRevenue\Update;
use FinancialControl\Actions\VariableRevenue\ListAction;
use FinancialControl\Http\Requests\VariableExpenseOrRevenue\SaveRequest;
use FinancialControl\Http\Requests\VariableExpenseOrRevenue\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VariableRevenueController extends Controller
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
            $action = resolve(ListAction::class, [ 'data' => $request->all() ]);

            $revenues = $action->run();

            return response()->json($revenues ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getById(IdRequest $request)
    {
        try {
            $action = resolve(GetById::class, ['data' => [ 'id' => $request->route('id') ]]);
            $revenue = $action->run();

            if (empty($revenue)) throw new NotFoundException();

            return response()->json($revenue);

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
                    'update_data' => array_merge(
                        $request->all(),
                        [ 'user_id' => Auth::user()->id ]
                    )
                ]
            ]);

            $revenue = $action->run();

            return response()->json($revenue);

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
