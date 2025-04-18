<?php

namespace App\Http\Requests\Categories;

use App\Models\Category;
use InfyOm\Generator\Request\APIRequest;

class UpdateCategoryRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Category::$update_rules;
        return $rules;
    }
}
