<?php

namespace FinancialControl\Http\Controllers;

use Exception;
use FinancialControl\Actions\FixedRevenue\Save;
use FinancialControl\Http\Requests\FixedRevenue\SaveRequest;

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
}
