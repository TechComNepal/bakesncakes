<?php

namespace App\Providers;

use App\Contracts\Advertisements\AdvertisementContract;
use App\Contracts\Brands\BrandContract;
use App\Contracts\Categories\CategoryContract;
use App\Contracts\Products\ProductContract;
use App\Contracts\Profiles\AdminProfileContract;
use App\Contracts\Promocodes\PromocodeContract;
use App\Contracts\Sliders\SliderContract;
use App\Contracts\Users\UserContract;
use App\Repositories\Advertisements\AdvertisementRepository;
use App\Repositories\Products\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Brands\BrandRepository;
use App\Repositories\Categories\CategoryRepository;
use App\Repositories\Profiles\AdminProfileRepository;
use App\Repositories\Promocodes\PromocodeRepository;
use App\Repositories\Sliders\SliderRepository;
use App\Repositories\Users\UserRepository;

class RepositoriesServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class => CategoryRepository::class,
         BrandContract::class => BrandRepository::class,
        ProductContract::class => ProductRepository::class,
        AdminProfileContract::class=>AdminProfileRepository::class,
        UserContract::class=>UserRepository::class,
        PromocodeContract::class=>PromocodeRepository::class,
        SliderContract::class=>SliderRepository::class,
        AdvertisementContract::class=>AdvertisementRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
