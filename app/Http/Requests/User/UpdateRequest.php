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
            'name' => 'required|string|max:100'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "name.required" => "O campo nome é obrigatório.",
            "name.string" => "O nome deve ser do tipo texto alfanumérico.",
            "name.max" => "O nome não pode ter mais de :max caracteres.",
        ];
    }
}
