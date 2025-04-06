<?php

namespace App\Http\Requests\Zones;

use App\Models\Zone;
use InfyOm\Generator\Request\APIRequest;

class UpdateZoneRequest extends APIRequest
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
        return Zone::$update_rules;
    }
}
