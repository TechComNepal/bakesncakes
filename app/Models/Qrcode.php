<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Qrcode extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded=['id'];

    protected $casts=
    [
    'status'=>'boolean',
    ];

    protected static $defaultImage='/demo_images/qr-code/qrcode.jpeg';

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('qrimage')
        ->singleFile();
    }

    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);

        return $url ?: $this::$defaultImage ?? '';
    }
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value==='on' ? 1 : 0 ;
    }
}
