<?php

namespace FinancialControl\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use FinancialControl\Http\Requests\IdRequest;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Actions\FinancialTransaction\Save;
use FinancialControl\Actions\FinancialTransaction\Delete;
use FinancialControl\Actions\FinancialTransaction\Update;
use FinancialControl\Actions\FinancialTransaction\GetById;
use FinancialControl\Actions\FinancialTransaction\ListAction;
use FinancialControl\Http\Requests\FinancialTransaction\SaveRequest;
use FinancialControl\Http\Requests\FinancialTransaction\UpdateRequest;

class FinancialTransactionController extends Controller
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
            $action = resolve(ListAction::class, [
                'data' => $request->all()
            ]);

            $financialTransactions = $action->run();

            return response()->json($financialTransactions ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getById(IdRequest $request)
    {
        try {
            $action = resolve(GetById::class, ['data' => [ 'id' => $request->route('id') ]]);
            $financialTransaction = $action->run();

            if (empty($financialTransaction)) throw new NotFoundException();

            return response()->json($financialTransaction);

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

            $financialTransaction = $action->run();

            return response()->json($financialTransaction);

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
