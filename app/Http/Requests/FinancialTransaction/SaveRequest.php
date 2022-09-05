<?php

namespace App\Http\Requests\FinancialTransaction;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

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
            'type' => [
                'required',
                Rule::in(['expense', 'revenue'])
            ],
            'value' => 'required|numeric|min:0.1',
            'category_id' => 'required|integer',
            'register_date' => 'required|date_format:Y-m-d',
        ];
    }
}
