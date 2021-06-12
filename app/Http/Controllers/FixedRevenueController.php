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
            $activationControlData = $request->get('activation_control');

            $action = resolve(Save::class, [
                'data' => [
                    'title' => $request->get('title'),
                    'description' => $request->get('description'),
                    'value' => $request->get('value'),
                    'activation_control' => [
                        'start_date' => data_get($activationControlData, 'start_date'),
                        'end_date' => data_get($activationControlData, 'end_date'),
                        'activation_day' => data_get($activationControlData, 'activation_day'),
                        'activation_type' => data_get($activationControlData, 'activation_type'),
                    ]
                ]
            ]);

            return response()->json($action->run(), 201);

        } catch (Exception $e) {
            return response()->json([], $e->getCode());
        }
    }
}
