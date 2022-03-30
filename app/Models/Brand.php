<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Brand extends Model implements HasMedia, Searchable
{
    use HasFactory, HasSlug, InteractsWithMedia;
    protected static $defaultImage = '/common/default-image/defaultBrand.jpg';

    protected $fillable=['name','slug','short_description','status','user_id'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function getSearchResult(): SearchResult
    {
//        $url = route('site.product.show', $this->slug);

        $url = '';
        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value==='on' ? 1 : 0 ;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function getcategory()
    {
        return implode(", ", $this->categories->pluck('name')->toArray());
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('brands')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('original')
            ->fit(Manipulations::FIT_CROP, 1100, 640)
            ->performOnCollections('brands');

        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->performOnCollections('brands');
    }

    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);

        return $url ?: $this::$defaultImage ?? '';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function promocodes()
    {
        return $this->morphToMany(Promocode::class, 'promocodeable')->withTimestamps();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
