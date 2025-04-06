<?php

namespace App\Repositories;

use App\Models\Zone;

class ZoneRepository extends BaseRepository
{
    protected array $fieldSearchable = [
        'name',
        'description',
        'store_id',
        'coordinates'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Zone::class;
    }
}
