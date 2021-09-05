<?php

namespace FinancialControl\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use FinancialControl\Actions\Category\Save;
use FinancialControl\Http\Requests\IdRequest;
use FinancialControl\Actions\Category\Update;
use FinancialControl\Actions\Category\Delete;
use FinancialControl\Actions\Category\ListAll;
use FinancialControl\Actions\Category\GetById;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Http\Requests\Category\DeleteRequest;
use FinancialControl\Http\Requests\Category\SaveRequest;
use FinancialControl\Http\Requests\Category\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function save(SaveRequest $request)
    {
        try {
            $action = resolve(Save::class, [
                'data' => array_merge(
                    $request->all(),
                    [ 'user_id' => Auth::user()->id ]
                ),
            ]);

            return response()->json($action->run(), 201);

        } catch (Exception $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getById(IdRequest $request)
    {
        try {
            $action = resolve(GetById::class, ['data' => [ 'id' => $request->route('id') ]]);
            $category = $action->run();

            if (empty($category)) throw new NotFoundException();

            return response()->json($category);

        } catch (Exception $e) {
            return response()->json('', $e->getCode());
        }
    }

    public function listAll(Request $request)
    {
        try {
            $action = resolve(ListAll::class, [
                'data' => [
                    'params' => $request->query(),
                ],
            ]);

            $categories = $action->run();

            return response()->json($categories ?? []);

        } catch (Exception $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $action = resolve(Update::class, [
                'data' => [
                    'id' => $request->route('id'),
                    'data' => array_merge(
                        $request->all(),
                        [ 'user_id' => Auth::user()->id ]
                    ),
                ]
            ]);

            $category = $action->run();

            return response()->json($category);

        } catch (Exception $e) {
            return response()->json("", $e->getCode());
        }
    }

    public function delete(DeleteRequest $request)
    {
        try {
            $action = resolve(Delete::class, [ 'data' => ['id' => $request->route('id') ]]);
            $action->run();

            return response()->json("");

        } catch (Exception $e) {
            return response()->json("", $e->getCode());
        }
    }
}
