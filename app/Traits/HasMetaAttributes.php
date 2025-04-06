<?php
namespace App\Traits;

trait HasMetaAttributes
{
    public function getFlatMeta()
    {
        if (! $this->relationLoaded('meta')) {
            $this->load('meta');
        }

        return $this->meta->pluck('meta_value', 'meta_key');
    }

    public function getMetaValue($key, $default = null)
    {
        return $this->getFlatMeta()->get($key, $default);
    }
}
