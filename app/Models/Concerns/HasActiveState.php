<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasActiveState
{
    public function scopeActive(Builder $query,bool $value = true)
    {
        return $query->where('status',$value);
    }

    public function scopeInactive(Builder $query)
    {
        return $query->active(false);
    }

    public function activate()
    {
        return $this->setActiveColumn(true);
    }

    public function deactivate()
    {
        return $this->setActiveColumn(false);
    }

    public function setActiveColumn(bool $value)
    {
        $this->attributes['status'] = $value;
        return $this;
    }


}
