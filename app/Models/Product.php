<?php

namespace App\Models;

use App\Traits\Rateable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model implements HasMedia, Searchable
{
    use HasFactory, HasSlug, InteractsWithMedia;
    use Rateable;

    protected $guarded = ['id'];
    protected $casts=[
        'is_featured'=>'boolean',
        'is_taxable'=>'boolean',
        'is_refundable'=>'boolean',
        'is_trending'=>'boolean',
         'is_sellable'=>'boolean',
         'best_selling'=>'boolean',
          'is_deal'=>'boolean',
          

    ];

    protected $dates=['deal_date'];
   
    protected static $defaultImage = '/common/default-image/defaultCategoryImage.jpg';

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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function setIsFeaturedAttribute($value)
    {
        $this->attributes['is_featured'] = $value==='on' ? 1 : 0 ;
    }

    public function setIsTaxableAttribute($value)
    {
        $this->attributes['is_taxable'] = $value==='on' ? 1 : 0 ;
    }
    public function setIsRefundableAttribute($value)
    {
        $this->attributes['is_refundable'] = $value==='on' ? 1 : 0 ;
    }
    public function setIsTrendingAttribute($value)
    {
        $this->attributes['is_trending'] = $value==='on' ? 1 : 0 ;
    }
    public function setIsSellableAttribute($value)
    {
        $this->attributes['is_sellable'] = $value==='on' ? 1 : 0 ;
    }
    public function setBestSellingAttribute($value)
    {
        $this->attributes['best_selling'] = $value==='on' ? 1 : 0 ;
    }
    public function setIsDealAttribute($value)
    {
        $this->attributes['is_deal'] = $value==='on' ? 1 : 0 ;
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile();

        $this->addMediaCollection('gallery_image');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('original')
            ->fit(Manipulations::FIT_CROP, 1100, 640)
            ->performOnCollections('image', 'gallery_image');

        $this->addMediaConversion('square-md-thumb')
            ->fit(Manipulations::FIT_CROP, 370, 300)
            ->performOnCollections('image', 'gallery_image');

        $this->addMediaConversion('square-sm-thumb')
            ->fit(Manipulations::FIT_CROP, 170, 100)
            ->performOnCollections('image', 'gallery_image');
    }

    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);

        return $url ?  : $this::$defaultImage ?? '';
    }

    public function promocodes()
    {
        return $this->morphToMany(Promocode::class, 'promocodeable')->withTimestamps();
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    
    public function scopeHasStock($query)
    {
        return $query->where('quantity', '>', 0);
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')
                      ->withPivot('user_id', 'price', 'quantity', 'total', 'status', 'tax', 'delivery_date', 'user_note')
                     ->withTimestamps();
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }
}
