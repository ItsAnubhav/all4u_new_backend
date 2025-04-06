<?php

namespace App\Repositories;

use App\Models\Store;

class StoreRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'created_by',
        'name',
        'description',
        'slug',
        'address_line_1',
        'address_line_2',
        'store_lat',
        'is_active',
        'store_lng',
        'phone',
        'email',
        'store_currency'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Store::class;
    }
}
