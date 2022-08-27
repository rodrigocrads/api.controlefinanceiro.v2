<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Actions\Category\Save;
use App\Http\Requests\IdRequest;
use App\Actions\Category\Update;
use App\Actions\Category\Delete;
use App\Actions\Category\ListAll;
use App\Actions\Category\GetById;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Category\DeleteRequest;
use App\Http\Requests\Category\SaveRequest;
use App\Http\Requests\Category\UpdateRequest;
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
