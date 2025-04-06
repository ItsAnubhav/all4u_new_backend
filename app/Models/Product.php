<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';

    public $fillable = [
        'created_by',
        'store_id',
        'name',
        'description',
        'parent_id',
        'product_type',
        'review_count',
        'avg_review',
        'is_active'
    ];

    protected $casts = [
        'id' => 'integer',
        'created_by' => 'integer',
        'store_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'parent_id' => 'integer',
        'product_type' => 'decimal:2',
        'review_count' => 'string',
        'avg_review' => 'string',
        'is_active' => 'string'
    ];

    public static array $create_rules = [
        'created_by' => 'required',
        'store_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'parent_id' => 'required',
        'product_type' => 'required',
        'review_count' => 'required',
        'avg_review' => 'required',
        'is_active' => 'nullable'
    ];

    public static array $update_rules = [
        'created_by' => 'required',
        'store_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'parent_id' => 'required',
        'product_type' => 'required',
        'review_count' => 'required',
        'avg_review' => 'required',
        'is_active' => 'nullable'
    ];


}
