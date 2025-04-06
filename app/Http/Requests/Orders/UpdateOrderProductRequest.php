<?php

namespace App\Http\Requests\Orders;

use App\Models\OrderProduct;
use InfyOm\Generator\Request\APIRequest;

class UpdateOrderProductRequest extends APIRequest
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
        return OrderProduct::$update_rules;
    }
}
