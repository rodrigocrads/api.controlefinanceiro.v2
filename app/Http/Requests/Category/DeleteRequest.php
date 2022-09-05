<?php

namespace App\Http\Requests\Category;

use App\Custom\Validation\CategoryInUse;
use App\Custom\Validation\CategoryNotFound;
use App\Http\Requests\CustomFormRequest;

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
