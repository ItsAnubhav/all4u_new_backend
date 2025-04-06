<?php

namespace App\Http\Requests\Products;

use App\Models\Product;
use InfyOm\Generator\Request\APIRequest;

class CreateProductRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return Product::$create_rules;
    }
}
