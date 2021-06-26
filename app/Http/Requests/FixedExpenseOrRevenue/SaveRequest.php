<?php

namespace FinancialControl\Http\Requests\FixedExpenseOrRevenue;

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
            'activation_control.start_date' => 'required|date_format:Y-m-d',
            'activation_control.end_date' => 'nullable|date_format:Y-m-d',
            'activation_control.expiration_day' => 'required|integer',
            'activation_control.periodicity' => 'required|in:monthly,quarterly,semiannual,annual',
        ];
    }
}
