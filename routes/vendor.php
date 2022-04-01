<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vendor\BrandController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ProfileController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\vendor\ReportManagementController;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['role:vendor'], 'prefix' => '/vendor', 'as' => 'vendor.'], function () {

        //Dashboard
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');

        //Brand
        Route::get('/brands/status/toggle', [BrandController::class, 'toggleIsStatus'])->name('brands.toggle.status');
        Route::resource('/brands', BrandController::class)->names('brands')->except('show');

        //Products
        Route::get('/products/taxable/toggle', [ProductController::class, 'toggleIsTaxable'])->name('products.toggle.taxable');
        Route::get('/products/featured/toggle', [ProductController::class, 'toggleIsFeatured'])->name('products.toggle.featured');
        Route::get('/products/refundable/toggle', [ProductController::class, 'toggleIsRefundable'])->name('products.toggle.refundable');
        Route::get('/products/trending/toggle', [ProductController::class, 'toggleIsTrending'])->name('products.toggle.trending');
        Route::get('/products/sellable/toggle', [ProductController::class, 'toggleIsSellable'])->name('products.toggle.sellable');

        Route::delete('/products-gallery/{gallery}', [ProductController::class, 'galleryDestroy'])->name('products.gallery.destroy');
        Route::put('/products-gallery/{product}', [ProductController::class, 'galleryUpdate'])->name('products.gallery.update');

        Route::resource('/products', ProductController::class)->names('products')->except('show');

        //Profile
        Route::get('/profiles', [ProfileController::class,'index'])->name('profiles.index');
        Route::put('/profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');
        Route::post('/profiles/change/password', [ProfileController::class, 'changePassword'])->name('profiles.change.password');

        //Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

        Route::get('/product-stock/view', [ReportManagementController::class,'viewStock'])->name('productStock.view');
        Route::get('/product-sold/view', [ReportManagementController::class,'viewSoldProduct'])->name('productSold.view');
    });
});
