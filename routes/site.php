<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\PagesController;
use App\Http\Controllers\Site\ReviewController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\WishlistController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Site\SiteOrderController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Site\ContactMailController;
use App\Http\Controllers\Site\CustomOrderController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Site\SiteCategoryController;
use App\Http\Controllers\User\UserDashboardController;

Route::get('product/quick-view', [PagesController::class, 'quickView'])->name('product.quickView');

Route::get('/', [PagesController::class, 'index'])->name('site.page');


Route::get('/contactus', [PagesController::class, 'contactus'])->name('site.page.contact');
Route::get('/aboutus', [PagesController::class, 'aboutus'])->name('site.page.aboutus');
Route::get('/privacyAndPolicy', [PagesController::class, 'privacyAndPolicy'])->name('site.page.privacyAndPolicy');
Route::get('/termsAndCondition', [PagesController::class, 'termsAndCondition'])->name('site.page.termsAndCondition');
Route::get('/blog', [PagesController::class, 'blog'])->name('site.page.blog');
Route::get('/blog-details/{slug}', [PagesController::class, 'singleblog'])->name('site.page.singleblog');
Route::get('/vendors', [PagesController::class, 'vendor'])->name('site.page.vendor');
Route::get('/vendor-guide', [PagesController::class, 'vendor_guide'])->name('site.page.vendor_guide');
Route::get('/product-details/{id}', [ProductController::class, 'singleProductShow'])->name('site.page.singleProductShow');
Route::post('custom-order', [CustomOrderController::class, 'store'])->name('site.page.customOrder.store');

Route::post('/newsletters', [NewsLetterController::class, 'subscribe'])->name('newsletters.subscribe');

Route::get('/all-Product', [ProductController::class, 'allProductShow'])->name('site.page.allProductShow');

Route::get('/shop', [SiteCategoryController::class, 'categoryShow'])->name('site.category');
Route::get('/shop/{slug}', [SiteCategoryController::class, 'getCategoryProducts'])->name('site.categories.getProducts');

Route::get('/service', [PagesController::class, 'service'])->name('site.page.service');
Route::get('/service-details/{slug}', [PagesController::class, 'singleService'])->name('site.page.singleService');

Route::get('/auto-search', [PagesController::class, 'autoSearch'])->name('site.page.autoSearch');
Route::get('/search', [PagesController::class, 'search'])->name('site.page.search');

Route::post('contact/store', [ContactMailController::class, 'sendMail'])->name('site.contact.store');
// Route::get('/list-of-contact', [ContactMailController::class, 'contactList'])->name('contactUs.list');
Route::DELETE('contact/{contatMail}', [ContactMailController::class, 'contactdelete'])->name('contactUs.delete');
Route::get('/contacts/status/toggle', [ContactMailController::class, 'toggleIsStatus'])->name('contacts.toggle.status');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/addtocart', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::post('/cart/removeFromCart', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::post('/cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout');
    Route::post('/order-checkout', [PagesController::class, 'newCheckout'])->name('new.checkout');
    Route::post('order/cashondelivery', [SiteOrderController::class, 'cashOnDelivery'])->name('order.cashOnDelivery');
    Route::post('shipping/address', [SiteOrderController::class, 'shippingAddress'])->name('user.shipping.address');
    Route::get('shipping/address/edit/{id}', [SiteOrderController::class, 'editShippingAddress'])->name('user.shipping.address.edit');
    Route::put('shipping/address/edit/{id}', [SiteOrderController::class, 'updateShippingAddress'])->name('user.shipping.address.update');
    Route::delete('shipping/address/delete/{id}', [SiteOrderController::class, 'deleteShippingAddress'])->name('user.shipping.address.delete');
    Route::post('/price/after/apply/coupon', [SiteOrderController::class, 'priceAfterApplyCoupon'])->name('user.price.after.apply.coupon');
    Route::get('shipping/address/set_default/{id}', [SiteOrderController::class, 'setDefaultShippingAddress'])->name('user.shipping.address.set_default');
    Route::get('shipping-info', [SiteOrderController::class, 'get_shipping_info'])->name('user.shipping.info');
    Route::post('delivery-info', [SiteOrderController::class, 'store_shipping_info'])->name('user.shipping.info.store');
    Route::any('payment-select', [SiteOrderController::class, 'store_delivery_info'])->name('user.store.delivery.info');

    


    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profiles', [UserProfileController::class, 'index'])->name('profiles.index');
        Route::put('/profiles/{user}', [UserProfileController::class, 'update'])->name('profiles.update');
        Route::post('/profiles/change/password', [UserProfileController::class, 'changePassword'])->name('profiles.change.password');
        Route::post('/profiles/change/avatars', [UserProfileController::class, 'changeAvatar'])->name('profiles.change.avatar');

        Route::get('/orders', [UserDashboardController::class, 'showOrder'])->name('orders.show');
        Route::get('/orders/status/change', [UserDashboardController::class, 'statusChange'])->name('orders.status.change');
        Route::get('/orders/details/view/{id}', [UserDashboardController::class, 'viewOrderDetail'])->name('orders.details.view');
    });

    Route::post('/reviews', ReviewController::class)->name('review.store');
    Route::delete('/user/reviews/delete/{id}', [ReviewController::class, 'deleteReview'])->name('user.reviews.delete');
    Route::post('/user/comments', [ReviewController::class, 'showReview'])->name('user.comments');

    Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlists', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::post('/wishlists/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
});
