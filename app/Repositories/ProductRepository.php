<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
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

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Product::class;
    }
}
