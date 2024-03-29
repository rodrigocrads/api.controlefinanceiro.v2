<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\CustomFormRequest;

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
            'name' => 'required|string|max:100',
            'type' => 'required|in:revenue,expense'
        ];
    }
}
