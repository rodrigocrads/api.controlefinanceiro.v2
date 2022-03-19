<?php

namespace FinancialControl\Custom\Validation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NewPasswordIsNotEqualToCurrentPassword
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator)
    {
        $isEqualToCurrentPassword = Hash::check($value, Auth::user()->password);
        if ($isEqualToCurrentPassword) {
            return false;
        }

        return true;
    }
}