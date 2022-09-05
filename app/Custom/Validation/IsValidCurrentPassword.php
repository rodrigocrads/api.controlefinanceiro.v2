<?php

namespace App\Custom\Validation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IsValidCurrentPassword
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
        $isValidPassword = Hash::check($value, Auth::user()->password);
        if (! $isValidPassword) {
            return false;
        }

        return true;
    }
}