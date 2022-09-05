<?php

namespace App\Http\Requests\User;

use App\Http\Requests\CustomFormRequest;

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
            "old_password.min" => "Senha atual deve ter um valor mínimo de :min caracteres.",
            "old_password.max" => "Senha atual deve ter um valor máximo de :max caracteres.",
            "old_password.required" => "O campo senha atual é obrigatório.",
            "new_password.new_password_is_not_equal_to_current_password" => "Nova senha deve ter um valor diferente da senha atual.",
            "new_password.min" => "Nova senha deve ter um valor mínimo de :min caracteres.",
            "new_password.max" => "Nova senha deve ter um valor máximo de :max caracteres.",
            "new_password.required" => "O campo nova senha é obrigatório.",
        ];
    }
}
