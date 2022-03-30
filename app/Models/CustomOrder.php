<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CustomOrder extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;
    protected $fillable = ['slug','name','email','city','address','primary_number','secondary_number','quantity','date','description','status'];

    protected static $defaultImage = '/common/default-image/defaultImage.jpg';

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery_image');
    }


    public function registerMediaConversions(Media $media = null): void
    {

            
            $this->addMediaConversion('original')
            ->fit(Manipulations::FIT_CROP, 1100, 640)
            ->performOnCollections('gallery_image');

        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 170, 180)
            ->performOnCollections('gallery_image');

    }

    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);

        return $url ?: $this::$defaultImage ?? '';
    }


    public function getRouteKeyName(): string
    {
        return 'slug';
    }   
  

}
