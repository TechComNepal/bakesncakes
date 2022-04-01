<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\BlogController;
use App\Http\Controllers\Employee\BrandController;
use App\Http\Controllers\Employee\OrderController;
use App\Http\Controllers\Employee\ReportController;
use App\Http\Controllers\Employee\ProductController;
use App\Http\Controllers\Employee\ProfileController;
use App\Http\Controllers\Employee\CategoryController;
use App\Http\Controllers\employee\ReportManagementController;
use App\Http\Controllers\Employee\EmployeeDashboardController;

Route::middleware(['auth'])->prefix('employee')->name('employee.')->group(function () {

    //Dashboard
    Route::get('dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');

    //Categories
    Route::get('/categories/status/toggle', [CategoryController::class, 'toggleIsStatus'])->name('categories.toggle.status');
    Route::get('/categories/featured/toggle', [CategoryController::class, 'toggleIsFeatured'])->name('categories.toggle.featured');
    Route::get('/categories/menu/toggle', [CategoryController::class, 'toggleInMenu'])->name('categories.toggle.menu');
    Route::resource('/categories', CategoryController::class)->names('categories')->except('show');

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

    // for Blog
    Route::resource('/blogs', BlogController::class)->names('blogs')->except('show', 'destroy');
    Route::DELETE('/blogs/delete/{blog}', [BlogController::class, 'delete'])->name('blogs.delete');

    //Profile
    Route::get('/profiles', [ProfileController::class,'index'])->name('profiles.index');
    Route::put('/profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::post('/profiles/change/password', [ProfileController::class, 'changePassword'])->name('profiles.change.password');

    //Report
   
    Route::get('/product-stock/view', [ReportManagementController::class,'viewStock'])->name('productStock.view');


    //Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
});
