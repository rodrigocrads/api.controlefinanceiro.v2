<?php

namespace FinancialControl\Http\Controllers;

use Exception;
use FinancialControl\Action\Category\Save;
use FinancialControl\Action\Category\GetAll;
use FinancialControl\Action\Category\GetById;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Http\Requests\Category\SaveRequest;
use FinancialControl\Http\Requests\Category\GetByIdRequest;

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

    public function getById(GetByIdRequest $request)
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

    public function getAll()
    {
        try {
            $action = new GetAll();
            $categories = $action->run();

            return response()->json([$categories]);

        } catch (Exception $e) {
            return response()->json([], $e->getCode());
        }
    }
}
