<?php

use App\Http\Controllers\Employee\BlogController;
use App\Http\Controllers\Employee\BrandController;
use App\Http\Controllers\Employee\CategoryController;
use App\Http\Controllers\Employee\ProductController;
use App\Http\Controllers\Employee\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeDashboardController;

Route::middleware(['auth'])->prefix('employee')->name('employee.')->group(function (){

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
    Route::resource('/products', ProductController::class)->names('products')->except('show');

    // for Blog
    Route::resource('/blogs', BlogController::class)->names('blogs')->except('show', 'destroy');
    Route::DELETE('/blogs/delete/{blog}', [BlogController::class, 'delete'])->name('blogs.delete');

    //Profile
    Route::get('/profiles', [ProfileController::class,'index'])->name('profiles.index');
    Route::put('/profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::post('/profiles/change/password', [ProfileController::class, 'changePassword'])->name('profiles.change.password');

});
