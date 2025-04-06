<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public $table = 'order_products';

    public $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'unit_price',
        'total_price',
        'notes'
    ];

    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'product_id' => 'integer',
        'product_name' => 'string',
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'notes' => 'string'
    ];

    public static array $create_rules = [
        'order_id' => 'required',
        'product_id' => 'required',
        'product_name' => 'required',
        'quantity' => 'required',
        'unit_price' => 'required',
        'total_price' => 'required',
        'notes' => 'required'
    ];

    public static array $update_rules = [
        'order_id' => 'required',
        'product_id' => 'required',
        'product_name' => 'required',
        'quantity' => 'required',
        'unit_price' => 'required',
        'total_price' => 'required',
        'notes' => 'required'
    ];


}
