<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'country',
        'zip_code',
        'store_lat',
        'store_lng',
        'is_active',
        'phone',
        'email',
        'store_currency'
    ];

    protected $casts = [
        'id' => 'integer',
        'created_by' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'slug' => 'string',
        'address_line_1' => 'string',
        'address_line_2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'country' => 'string',
        'zip_code' => 'string',
        'store_lat' => 'decimal',
        'store_lng' => 'string',
        'is_active' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'store_currency' => 'string'
    ];

    public static array $create_rules = [
        'created_by' => 'required',
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required',
        'address_line_1' => 'required',
        'address_line_2' => 'required',
        'store_lat' => 'required',
        'store_lng' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'store_currency' => 'required',
        'is_active' => 'nullable',
    ];

    public static array $update_rules = [
        'created_by' => 'required',
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required',
        'address_line_1' => 'required',
        'address_line_2' => 'required',
        'store_lat' => 'required',
        'store_lng' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'store_currency' => 'required',
        'is_active' => 'nullable',
    ];


}
