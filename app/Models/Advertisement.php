<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Advertisement extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected static $defaultImage = '/common/default-image/defaultBrand.jpg';
    protected $fillable = [
        'name',
        'brand_id',
        'clicks',
        'rank',
        'columns',
        'advertisement_placement_id',
        'link',
        'status'
    ];

    protected $casts = [
        'brand_id' => 'int',
        'clicks' => 'int',
        'rank' => 'int',
        'columns' => 'int',
        'advertisement_placement_id' => 'int',
        'status' => 'bool'
    ];

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value ==='on' ? 1 : 0 ;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile();
    }

    public function advertisementPlacement()
    {
        return $this->belongsTo(AdvertisementPlacement::class, 'advertisement_placement_id');
    }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('card')
                    ->fit(Manipulations::FIT_CROP, 356, 241)
                    ->performOnCollections('image');

        $this->addMediaConversion('banner')
              ->fit(Manipulations::FIT_CROP, 1920, 600)
              ->performOnCollections('image');
    }


    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);

        return $url ?: $this::$defaultImage ?? '';
    }
}
