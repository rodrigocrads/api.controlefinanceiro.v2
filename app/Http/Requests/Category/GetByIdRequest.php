<?php

namespace FinancialControl\Http\Requests\Category;

use FinancialControl\Http\Requests\CustomFormRequest;

class GetByIdRequest extends CustomFormRequest
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
