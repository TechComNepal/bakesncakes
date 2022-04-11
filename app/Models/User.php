<?php

namespace App\Models;

use Lab404\Impersonate\Models\Impersonate;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Image\Manipulations;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Notifications\UserEmailVerification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia, LogsActivity, Impersonate;

    protected static $defaultImage = '/common/default-image/defaultImage.png';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'city',
        'address',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $ignoreChangedAttributes = ['created_at', 'updated_at', 'password', 'provider_id'];
//    protected static $logFillable = true;
    protected static $logAttributesToIgnore = ['password', 'provider_id'];
//    protected static $logOnlyDirty = true;
//    protected static $logName = 'User';
//    protected static $submitEmptyLogs = false;

//    public function getDescriptionForEvent(string $eventName): string
//    {
//        return "User has been {$eventName}";
//    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('User')
            ->logFillable()
            ->dontLogIfAttributesChangedOnly(['created_at', 'updated_at', 'password', 'provider_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => "User has been {$eventName}");
    }


    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new UserEmailVerification());
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
             ->singleFile();

        $this->addMediaCollection('image')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('profile')
            ->fit(Manipulations::FIT_CROP, 80, 80)
            ->performOnCollections('avatars');

        $this->addMediaConversion('avatar')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->performOnCollections('avatars');


        $this->addMediaConversion('original')
            ->fit(Manipulations::FIT_CROP, 1100, 640)
            ->performOnCollections('image');

        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->performOnCollections('image');
    }

    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);

        return $url ?: $this::$defaultImage ?? '';
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function shipping_address()
    {
        return $this->hasMany(CustomerShippingAddress::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id');
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }
}
