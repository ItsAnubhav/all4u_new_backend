<?php

namespace App\Http\Requests\Stores;

use App\Models\Store;
use InfyOm\Generator\Request\APIRequest;

class UpdateStoreRequest extends APIRequest
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
        return Store::$update_rules;
    }
}
