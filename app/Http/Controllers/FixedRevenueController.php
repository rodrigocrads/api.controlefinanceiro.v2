<?php

namespace FinancialControl\Http\Controllers;

use Exception;
use FinancialControl\Actions\FixedRevenue\ListAll;
use FinancialControl\Actions\FixedRevenue\Save;
use FinancialControl\Exceptions\NotFoundException;
use FinancialControl\Http\Requests\FixedRevenue\SaveRequest;
use FinancialControl\Http\Requests\IdRequest;

class FixedRevenueController extends Controller
{
    public function save(SaveRequest $request)
    {
        try {
            $action = resolve(Save::class, [
                'data' => [
                    'title' => $request->get('title'),
                    'description' => $request->get('description'),
                    'value' => $request->get('value'),
                    'activation_control' => $request->get('activation_control')
                ]
            ]);

            return response()->json($action->run(), 201);

        } catch (Exception $e) {
            return response()->json([], $e->getCode());
        }
    }

    public function listAll()
    {
        try {
            $action = resolve(ListAll::class);

            $fixedRevenues = $action->run();

            return response()->json($fixedRevenues ?? []);

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
}
