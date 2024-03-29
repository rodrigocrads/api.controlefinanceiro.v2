<?php

namespace App\Http\Requests\Entry;

use Illuminate\Validation\Rule;
use App\Http\Requests\CustomFormRequest;

class UpdateRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'   => 'required|int',
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
