<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';

    public $fillable = [
        'store_id',
        'user_id',
        'order_status',
        'order_date',
        'shipping_date',
        'total_amt',
        'payment_status',
        'shipping_method',
        'shipping_address',
        'billing_address'
    ];

    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'user_id' => 'integer',
        'order_status' => 'string',
        'order_date' => 'datetime',
        'shipping_date' => 'datetime',
        'total_amt' => 'decimal:2',
        'payment_status' => 'string',
        'shipping_method' => 'string',
        'shipping_address' => 'string',
        'billing_address' => 'string'
    ];

    public static array $create_rules = [
        'store_id' => 'required',
        'user_id' => 'required',
        'order_status' => 'required',
        'order_date' => 'required',
        'shipping_date' => 'required',
        'total_amt' => 'required',
        'payment_status' => 'required',
        'shipping_method' => 'required',
        'shipping_address' => 'nullable',
        'billing_address' => 'nullable'
    ];

    public static array $update_rules = [
        'store_id' => 'required',
        'user_id' => 'required',
        'order_status' => 'required',
        'order_date' => 'required',
        'shipping_date' => 'required',
        'total_amt' => 'required',
        'payment_status' => 'required',
        'shipping_method' => 'required',
        'shipping_address' => 'nullable',
        'billing_address' => 'nullable'
    ];


}
