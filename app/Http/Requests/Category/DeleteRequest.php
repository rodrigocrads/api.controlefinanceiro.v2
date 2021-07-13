<?php

namespace FinancialControl\Http\Requests\Category;

use FinancialControl\Custom\Validation\CategoryInUse;
use FinancialControl\Custom\Validation\CategoryNotFound;
use FinancialControl\Http\Requests\CustomFormRequest;

class DeleteRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                'int',
                new CategoryInUse(),
                new CategoryNotFound(),
            ],
        ];
    }
}
