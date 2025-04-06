<?php

namespace App\Http\Requests\Categories;

use App\Models\Category;
use InfyOm\Generator\Request\APIRequest;

class CreateCategoryRequest extends APIRequest
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
        return Category::$create_rules;
    }
}
