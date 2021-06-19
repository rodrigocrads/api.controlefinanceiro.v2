<?php

namespace FinancialControl\Http\Requests\VariableExpenseOrRevenue;

use FinancialControl\Http\Requests\CustomFormRequest;

class SaveRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'value' => 'required|numeric|min:0.1',
            'category_id' => 'required|integer',
        ];
    }
}
