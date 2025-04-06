<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public $table = 'zone';

    public $fillable = [
        'name',
        'description',
        'store_id',
        'coordinates'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'store_id' => 'integer',
        'coordinates' => 'string'
    ];

    public static array $create_rules = [
        'name' => 'required',
        'description' => 'required',
        'store_id' => 'required',
        'coordinates' => 'required'
    ];

    public static array $update_rules = [
        'name' => 'required',
        'description' => 'required',
        'store_id' => 'required',
        'coordinates' => 'required'
    ];


}
