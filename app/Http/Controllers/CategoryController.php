<?php

namespace FinancialControl\Http\Controllers;

use Exception;
use FinancialControl\Actions\Category\Save;
use FinancialControl\Actions\Category\Update;
use FinancialControl\Actions\Category\Delete;
use FinancialControl\Actions\Category\ListAll;
use FinancialControl\Actions\Category\GetById;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Http\Requests\Category\IdRequest;
use FinancialControl\Http\Requests\Category\SaveRequest;
use FinancialControl\Http\Requests\Category\UpdateRequest;

class CategoryController extends Controller
{
    public function save(SaveRequest $request)
    {
        try {
            $action = new Save([
                'name' => $request->get('name'),
                'type' => $request->get('type'),
            ]);

            return response()->json($action->run(), 201);

        } catch (Exception $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function getById(IdRequest $request)
    {
        try {
            $action = new GetById(['id' => $request->route('id')]);
            $category = $action->run();

            if (empty($category)) throw new NotFoundException();

            return response()->json($category);

        } catch (Exception $e) {
            return response()->json('', $e->getCode());
        }
    }

    public function listAll()
    {
        try {
            $action = new ListAll();
            $categories = $action->run();

            return response()->json($categories ?? []);

        } catch (Exception $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $action = new Update([
                'id' => $request->route('id'),
                'data' => [
                    'name' => $request->get('name'),
                    'type' => $request->get('type'),
                ]
            ]);
            $category = $action->run();

            return response()->json($category);

        } catch (Exception $e) {
            return response()->json("", $e->getCode());
        }
    }

    public function delete(IdRequest $request)
    {
        try {
            $action = new Delete([
                'id' => $request->route('id'),
            ]);

            $action->run();

            return response()->json("");

        } catch (Exception $e) {
            return response()->json("", $e->getCode());
        }
    }
}
