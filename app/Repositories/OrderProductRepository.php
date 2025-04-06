<?php

namespace App\Repositories;

use App\Models\OrderProduct;

class OrderProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'unit_price',
        'total_price',
        'notes'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return OrderProduct::class;
    }
}
