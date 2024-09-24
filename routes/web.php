<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ManageCustomerController;
use App\Http\Controllers\Admin\ManageOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableCheckController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\OrderStatusNotificationController;


Route::group([], function () {
    Route::get('/check-table/{tableName}', [TableCheckController::class, 'checkTable']);
    //enquiry store
    Route::Post('enquiry/store', [EnquiryController::class, 'store'])->name('enquiry.store');

    //login
    Route::group(['controller' => LoginController::class], function () {
        Route::get('admin',  'index')->name('login');
        Route::post('admin/login',  'login')->name('login.post');
    });

    //google login
    Route::group(['controller' => SocialAuthController::class], function () {
        Route::get('/login/google', 'redirectToGoogle')->name('login.google');
        Route::get('/callback-url', 'handleGoogleCallback');
    });

    //cart
    Route::group(['controller' => CartController::class], function () {
        Route::get('cart', 'viewCart')->name('cart');
        Route::post('cart/store/{id}', 'addToCart')->name('cart.store');
        Route::post('cart/update/{id}', 'cartUpdate')->name('cart.update');
        Route::delete('cart/delete/{id}', 'cartDelete')->name('cart.delete');
        Route::post('coupon/apply{id}', 'couponApply')->name('coupon.apply');
    });

    //checkOut
    Route::group(['controller' => CheckoutController::class], function () {
        Route::get('checkout', 'checkOut')->name('checkout');
        Route::post('checkout/store', 'CheckoutPlaceOrderStore')->name('checkout.store');
        Route::get('makePayment', 'makePayment')->name('make.payment');
        Route::post('checkout/order/success', 'CheckoutOrderSuccess')->name('checkout.order.success');
    });

    //customer
    Route::group(['controller' => CustomerController::class], function () {
        Route::get('customer/register',  'create')->name('customer.create');
        Route::post('customer/store',  'store')->name('customer.store');
        Route::get('customer/login',  'custemerLogin')->name('customer.login');
        Route::post('customer/authenticate',  'login')->name('customer.authenticate');
        Route::get('customer/logout',  'logout')->name('customer.logout');
        Route::get('customer/profile',  'profile')->name('customer.profile');
        Route::post('customer/update',  'update')->name('customer.update');
        Route::get('customer/address/update',  'addressUpdate')->name('customer.address.update');
        Route::get('customer/product/show/{id}',  'customerProductShow')->name('customer.product.show');
    });

    //Order Status Notification
    Route::get('/orders/{id}', [OrderStatusNotificationController::class, 'show'])->name('order.show');

    //wishlist
    Route::group(['controller' => WishlistController::class], function () {
        Route::post('add-to-cart/{product_id}', 'addToWishlist')->name('add-to-wishlist');
        Route::delete('remove-from-wishlist/{id}', 'removeFromWishlist')->name('remove-from-wishlist');
    });

    // home
    Route::group(['controller' => HomeController::class], function () {
        Route::get('/', 'index')->name('home');
        Route::get('contact', 'contact')->name('contact');
        Route::get('/category/{urlkey}', 'category')->name('categoryData');
        Route::get('/product/{urlkey}', 'product')->name('productData');
        Route::get('/{urlkey}', 'page')->name('page');
    });
});

// admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'front_user']], function () {

    Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource("user", UserController::class);
    Route::resource("role", RoleController::class);
    Route::resource("permission", PermissionController::class);

    Route::resource("slider", SliderController::class);
    Route::resource("page", PageController::class);
    Route::post('ckeditor/upload', [PageController::class, 'upload'])->name('ckeditor.upload');
    Route::resource("block", BlockController::class);

    Route::resource("product", ProductController::class);
    Route::resource("category", CategoryController::class);
    Route::resource("attribute", AttributeController::class);
    Route::resource("coupon", CouponController::class);
    Route::resource('email-template',EmailTemplateController::class);

    //enquiry
    Route::group(['controller' => EnquiryController::class], function () {
        Route::get("enquiry", 'index')->name('enquiry');
        Route::post("enquiry/status", 'status')->name('enquiry.status');
        Route::delete("enquiry/destroy{id}", 'destroy')->name('enquiry.destroy');
    });

    //Manage Order
    Route::group(['controller' => ManageOrderController::class], function () {
        Route::get('order', 'index')->name('order.index');
        Route::get('/order/show{id}', 'show')->name('order.show');
        Route::post('order/status/{id}', 'updateStatus')->name('order.updateStatus');
        Route::get('order/invoice/{id}', 'generateInvoice')->name('order.invoice');
    });

    //Manage Customer
    Route::group(['controller' => ManageCustomerController::class], function () {
        Route::get('customer', 'index')->name('customer.index');
        Route::get('/customer/show{id}', 'show')->name('customer.show');
    });
});

// Route::fallback(function () {
//     return abort(404);
// });
