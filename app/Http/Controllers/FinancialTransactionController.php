<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\IdRequest;
use App\Exceptions\NotFoundException;
use App\Actions\FinancialTransaction\ListAction;
use App\Actions\FinancialTransaction\SaveAction;
use App\Actions\FinancialTransaction\DeleteAction;
use App\Actions\FinancialTransaction\UpdateAction;
use App\Actions\FinancialTransaction\GetByIdAction;
use App\Http\Requests\FinancialTransaction\SaveRequest;
use App\Http\Requests\FinancialTransaction\UpdateRequest;

class FinancialTransactionController extends Controller
{
    public function save(SaveRequest $request)
    {
        try {
            $action = resolve(SaveAction::class, [
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

            $result = $action->run();

            return response()->json($result ?? []);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getById(IdRequest $request)
    {
        try {
            $action = resolve(GetByIdAction::class, ['data' => [ 'id' => $request->route('id') ]]);
            $result = $action->run();

            if (empty($result)) {
                throw new NotFoundException();
            }

            return response()->json($result);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $action = resolve(UpdateAction::class, [
                'data' => [
                    'id' => $request->route('id'),
                    'update_data' => array_merge(
                        $request->all(),
                        [ 'user_id' => Auth::user()->id ]
                    )
                ]
            ]);

            $result = $action->run();

            return response()->json($result);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function delete(IdRequest $request)
    {
        try {
            $action = resolve(DeleteAction::class, [
                    'data' => ['id' => $request->route('id')]
                ]
            );
            $action->run();

            return response()->json([]);

        } catch (Throwable $e) {
            return response()->json([], $e->getCode());
        }
    }
}
