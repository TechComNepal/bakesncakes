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

class Category extends Model implements HasMedia, Searchable
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = ['name', 'level', 'order_level', 'status', 'slug', 'featured', 'in_menu', 'parent_id'];

    protected static $defaultImage = '/common/default-image/defaultCategoryImage.jpg';

    protected $casts=[
          'status'=>'boolean',
          'featured'=>'boolean',
          'in_menu'=>'boolean',
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

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function scopeMain($query)
    {
        return $query->where('parent_id', null);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value==='on' ? 1 : 0 ;
    }
  
    public function setFeaturedAttribute($value)
    {
        $this->attributes['featured'] = $value==='on' ? 1 : 0 ;
    }

    public function setInMenuAttribute($value)
    {
        $this->attributes['in_menu'] = $value === 'on' ? 1 : 0;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile();
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('original')
            ->fit(Manipulations::FIT_CROP, 1100, 640)
            ->performOnCollections('image');

        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->performOnCollections('image');
    }

    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);

        return $url ?: $this::$defaultImage ?? '';
    }

    public function promocodes()
    {
        return $this->morphToMany(Promocode::class, 'promocodeable')->withTimestamps();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
