<?php

namespace FinancialControl\Http\Requests\User;

use FinancialControl\Http\Requests\CustomFormRequest;

class ChangePasswordRequest extends CustomFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|string|min:6|max:50|is_valid_current_password',
            'new_password' => 'required|string|min:6|max:50|new_password_is_not_equal_to_current_password',
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
            "old_password.is_valid_current_password" => "Senha atual incorreta.",
            "new_password.new_password_is_not_equal_to_current_password" => "A nova senha deve ser diferente da senha atual."
        ];
    }
}
