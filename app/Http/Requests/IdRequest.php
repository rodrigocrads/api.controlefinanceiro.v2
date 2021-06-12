<?php

namespace FinancialControl\Http\Requests;

use FinancialControl\Http\Requests\CustomFormRequest;

class IdRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|int',
        ];
    }
}
