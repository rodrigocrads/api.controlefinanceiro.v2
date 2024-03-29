<?php

namespace App\Custom\Validation;

use Exception;
use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CategoryNotFound implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            if (empty($value)) {
                return false;
            }
    
            $category = Category::find($value);
    
            if (empty($category)) {
                return false;
            }
    
            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Category not Found!';
    }
}