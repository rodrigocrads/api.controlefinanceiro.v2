<?php

namespace FinancialControl\Http\Requests\User;

use FinancialControl\Http\Requests\CustomFormRequest;

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
            'name' => 'required|string|max:255',
            'id'   => 'required|int'
        ];
    }
}
