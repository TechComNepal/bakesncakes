<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasFeatured
{
    public function scopeFeatured(Builder $query,bool $value = true)
    {
        return $query->where('featured',$value);
    }

    public function scopeNotFeatured(Builder $query)
    {
        return $query->featured(false);
    }

    public function featured()
    {
        return $this->setFeaturedColumn(true);
    }

    public function notFeatured()
    {
        return $this->setFeaturedColumn(false);
    }

    public function setFeaturedColumn(bool $value)
    {
        $this->attributes['featured'] = $value;
        return $this;
    }

}
