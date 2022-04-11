<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();


        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%' . $string . '%') : $this;
        });


        if (Schema::hasTable('settings')) {
            View::share('setting', Settings::first());
        }
        if (Schema::hasTable('categories')) {
            View::share('menucategories', Category::where('in_menu', 1)->where('status', 1)->limit(28)->orderBy('id', 'desc')->get());
        }

        if (Schema::hasTable('products')) {
            View::share('menuproducts', Product::where('best_selling', 1)->limit(28)->orderBy(
                'id',
                'desc'
            )->get());
        }
    }
}
