<?php

use App\Models\CustomOrder;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Site\ContactMailController;
use App\Http\Controllers\Admin\CustomOrderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ReportManagementController;

Route::get('/users/impersonate-leave', [AdminCustomerController::class, 'impersonateLeave'])->name('users.impersonate.leave')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware'=>['role:admin|superadmin'] ,'prefix' => '/admin', 'as' => 'admin.'], function () {

        //Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        //Users
        Route::resource('/users', AdminCustomerController::class)->names('users')->except('show');
        Route::get('/users/customer/info/{user}', [AdminCustomerController::class, 'info'])->name('users.info');
        Route::get('/users/impersonate/{id}', [AdminCustomerController::class, 'impersonate'])->name('users.impersonate');
        Route::get('/users/activity/logs/{id}', [AdminCustomerController::class, 'userActivityLogsDatatable'])->name('users.activity.logs');
        Route::get('/users/cart/and/wishlist/{id}', [AdminCustomerController::class, 'userCartDatatable'])->name('users.cart.datatable');
        Route::post('/users/shipping/address', [AdminCustomerController::class, 'customerShippingAddressStore'])->name('customer.shipping.address');
        Route::get('/users/shipping/address/edit/{id}', [AdminCustomerController::class, 'editUserShippingAddress'])->name('users.shipping.address.edit');
        Route::put('/users/shipping/address/edit/{id}', [AdminCustomerController::class, 'updateUserShippingAddress'])->name('users.shipping.address.update');
        Route::get('/users/shipping/address/set_default/{id}', [AdminCustomerController::class, 'setDefaultShippingAddress'])->name('user.shipping.address.set_default');
        Route::get('/users/shipping/address/order/{id}', [AdminCustomerController::class, 'userOrderDatatable'])->name('users.shipping.address.order.datatable');
        Route::post('/users/import', [AdminCustomerController::class, 'importExcel'])->name('users.import');
        //Categories
        Route::get('/categories/status/toggle', [CategoryController::class, 'toggleIsStatus'])->name('categories.toggle.status');
        Route::get('/categories/featured/toggle', [CategoryController::class, 'toggleIsFeatured'])->name('categories.toggle.featured');
        Route::get('/categories/menu/toggle', [CategoryController::class, 'toggleInMenu'])->name('categories.toggle.menu');
        Route::resource('/categories', CategoryController::class)->names('categories')->except('show');
        //Brand
        Route::get('/brands/status/toggle', [BrandController::class, 'toggleIsStatus'])->name('brands.toggle.status');
        Route::resource('/brands', BrandController::class)->names('brands')->except('show');

        //Profile
        Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
        Route::put('/profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');
        Route::post('/profiles/change/password', [ProfileController::class, 'changePassword'])->name('profiles.change.password');

        //NewsLetter
        Route::get('/notifications/mark-as-read/{id}', [NewsLetterController::class, 'markSingleAsRead'])->name('notifications.markSingleRead');
        Route::get('/newsletters/mark-as-read', [NewsLetterController::class, 'markAsRead'])->name('newsletters.markRead');
        Route::get('/newsletters/lists', [NewsLetterController::class, 'index'])->name('newsletters.index');
        Route::delete('/newsletters/{newsletter}', [NewsLetterController::class, 'destroy'])->name('newsletters.destroy');
        Route::get('/newsletters/delete-all-read', [NewsLetterController::class, 'deleteAllRead'])->name('newsletters.deleteAllRead');

        //Notifications
        Route::get('/notifications/lists', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/orders', [NotificationController::class, 'orderList'])->name('notifications.orders');


        //Promocode
        Route::resource('/promocodes', PromoCodeController::class)->names('promocodes')->except(['show', 'edit', 'update']);

        //Slider
        Route::get('/sliders/status/toggle', [SliderController::class, 'toggleIsStatus'])->name('sliders.toggle.status');
        Route::get('/sliders/popup/toggle', [SliderController::class, 'toggleIsPopup'])->name('sliders.toggle.popup');
        Route::resource('/sliders', SliderController::class)->names('sliders')->except('show');

        //Advertisement
        Route::get('/advertisements/status/toggle', [AdvertisementController::class, 'toggleIsStatus'])->name('advertisements.toggle.status');
        Route::resource('/advertisements', AdvertisementController::class)->names('advertisements')->except('show');

        //Shipping
        Route::resource('/shippings', ShippingController::class)->names('shippings')->except('show');

        // Page controller
        // terms and condition
        Route::get('/terms-and-condition', [PagesController::class, 'termsAndConditionSetting'])->name('termsAndCondition.setting');
        Route::post('/termsAndCondition', [PagesController::class, 'termsAndConditionUpdate'])->name('termsAndCondition.update');
        // privacy and policy
        Route::get('/privacy-and-policy', [PagesController::class, 'privacyAndPolicySetting'])->name('privacyAndPolicy.setting');
        Route::post('/privacy-and-policy', [PagesController::class, 'privacyAndPolicyUpdate'])->name('privacyAndPolicy.update');
        // About Us
        Route::get('about-us', [PagesController::class, 'aboutUsSetting'])->name('aboutUs.setting');
        Route::post('/about-us', [PagesController::class, 'aboutUsUpdate'])->name('aboutUs.update');

        // for Blog
        Route::resource('/blogs', BlogController::class)->names('blogs')->except('show', 'destroy');
        Route::DELETE('/blogs/delete/{blog}', [BlogController::class, 'delete'])->name('blogs.delete');

        // Custom Order
        Route::resource('/custom-order', CustomOrderController::class)->names('customOrder')->except('show', 'destroy');
        // Route::get('/orders/{customOrder}', [CustomOrderController::class, 'show'])->name('orders.show');
        Route::put('/custom-orders/{customOrder}', [CustomOrderController::class, 'update'])->name('customOrders.update');
        
        Route::DELETE('/custom-order/delete/{customOrder}', [CustomOrderController::class, 'delete'])->name('custoOrder.delete');
        Route::get('/custom-order-report/status/toggle', [CustomOrderController::class, 'toggleIsStatus'])->name('customOrder.toggle.status');



        // for Service
        Route::resource('/service', ServiceController::class)->names('services')->except('show', 'destroy');
        Route::DELETE('/service/delete/{service}', [ServiceController::class, 'delete'])->name('service.delete');

        // for Testimonials
        Route::resource('/testimonials', TestimonialController::class)->names('testimonials')->except('show', 'destroy');
        Route::DELETE('/testimonial/delete/{testimonial}', [TestimonialController::class, 'delete'])->name('testimonial.delete');


        // Contact Mail
        Route::get('contact', [ContactMailController::class, 'index'])->name('contact.index');
        Route::get('/list-of-contact', [ContactMailController::class, 'contactList'])->name('contactUs.list');
        // Route::post('contact/store', [ContactMailController::class, 'sendMail'])->name('contact.store');
        // Route::DELETE('contact/{contactMail}', [ContactMailController::class, 'contactdelete'])->name('contactUs.delete');



        //Products
        Route::delete('/products-gallery/{gallery}', [ProductController::class, 'galleryDestroy'])->name('products.gallery.destroy');
        Route::put('/products-gallery/{product}', [ProductController::class, 'galleryUpdate'])->name('products.gallery.update');
        Route::resource('/products', ProductController::class)->names('products')->except('show');

        //Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        // Route::get('/product-stock/view', [ReportManagementController::class,'stockList'])->name('productStock.view');

        Route::get('/product-stock/view', [ReportManagementController::class,'viewStock'])->name('productStock.view');
        // Route::get('/custom-order-report/view', [ReportManagementController::class,'customOrderReport'])->name('customOrderReports.view');




        //Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('setting.store');
        Route::get('/settings/social/media', [SettingController::class, 'socialMediaIndex'])->name('setting.social.media.index');
        Route::post('/settings/social/media', [SettingController::class, 'socialMediaUpdate'])->name('setting.social.media.update');
        Route::get('/settings/roles-permission', [SettingController::class, 'rolesPermissionIndex'])->name('setting.roles.permission.index');
        Route::post('/settings/roles-permission', [SettingController::class, 'rolesPermissionStore'])->name('setting.roles.permission.store');
        Route::post('/settings/create-roles', [SettingController::class, 'createRoles'])->name('setting.create.roles');
        Route::get('/settings/manage-roles-permission', [SettingController::class, 'manageRolesPermissionIndex'])->name('setting.manage.roles.permission.index');
        Route::post('/settings/assign-all-roles-permission', [SettingController::class, 'rolesPermissionAssignAllPermission'])->name('setting.roles.permission.assign.all.permission');
        Route::get('/settings/qrcode', [SettingController::class, 'qrcodeIndex'])->name('setting.qrcode.index');
        Route::post('/settings/qrcode', [SettingController::class, 'qrcodeUpdate'])->name('setting.qrcode.update');
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
