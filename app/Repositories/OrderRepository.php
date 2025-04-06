<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    protected $fieldSearchable = [
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

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Order::class;
    }
}
