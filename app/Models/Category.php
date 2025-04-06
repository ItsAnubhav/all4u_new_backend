<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';

    public $fillable = [
        'store_id',
        'parent_id',
        'name',
        'description',
        'slug'
    ];

    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'parent_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'slug' => 'string'
    ];

    public static array $create_rules = [
        'store_id' => 'required',
        'parent_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required'
    ];

    public static array $update_rules = [
        'store_id' => 'required',
        'parent_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required'
    ];


}
