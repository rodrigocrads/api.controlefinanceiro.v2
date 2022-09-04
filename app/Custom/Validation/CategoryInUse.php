<?php

namespace App\Custom\Validation;

use App\Models\Category;
use Exception;
use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Contracts\Validation\Rule;

class CategoryInUse implements Rule
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
            $repository = resolve(ICategoryRepository::class);
            
            if (empty($value)) {
                return false;
            }
            
            /** @var Category */
            $category = $repository->find($value);

            if (!empty($category)) {
                return !$category->hasSomeFinancialTransaction();
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
        return 'Esta categoria está sendo utilizada!';
    }
}