<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slider extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable=['brand_id','status','is_popup'];

    protected $casts=
    [
    'brand_id'=>'integer',
    'status'=>'boolean',
    'is_popup'=>'boolean',
    ];

    protected static $defaultImage='/common/default-image/defaultSlider.jpg';

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('desktop')
            ->singleFile();

        $this->addMediaCollection('mobile')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('original')
            ->fit(Manipulations::FIT_CROP, 1920, 600)
            ->performOnCollections('desktop');

        $this->addMediaConversion('mid_thumb')
            ->fit(Manipulations::FIT_CROP, 546, 533)
            ->performOnCollections('desktop');

        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 150, 150)
            ->performOnCollections('desktop');
    }

    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);

        return $url ?: $this::$defaultImage ?? '';
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value==='on' ? 1 : 0 ;
    }

    public function setIsPopupAttribute($value)
    {
        $this->attributes['is_popup']=$value==='on' ? 1 : 0 ;
    }
}
