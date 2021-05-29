<?php

namespace FinancialControl\Http\Controllers;

use Exception;
use FinancialControl\Action\Category\Save;
use FinancialControl\Http\Requests\Category\SaveRequest;

class CategoryController extends Controller
{
    public function save(SaveRequest $request)
    {
        try {
            $action = new Save([
                'name' => $request->get('name'),
                'type' => $request->get('type'),
            ]);

            return response()->json(
                [
                    'message' => 'Registro salvo com sucesso!',
                    'data' => $action->run(),
                ]
            );

        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                $e->getCode()
            );
        }
    }
}
