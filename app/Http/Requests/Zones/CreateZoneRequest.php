<?php

namespace App\Http\Requests\Zones;

use App\Models\Zone;
use InfyOm\Generator\Request\APIRequest;

class CreateZoneRequest extends APIRequest
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
        return Zone::$create_rules;
    }
}
