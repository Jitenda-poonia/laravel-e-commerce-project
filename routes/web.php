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
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 

Route::group([], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::Post('enquiry/store', [EnquiryController::class, 'store'])->name('enquiry.store');
    Route::get('admin', [LoginController::class, 'index'])->name('login');
    Route::post('admin/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('cart', [CartController::class, 'viewCart'])->name('cart');
    Route::post('cart/store/{id}', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('cart/update/{id}', [CartController::class, 'cartUpdate'])->name('cart.update');
    Route::delete('cart/delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');

    Route::post('coupon/apply{id}', [CartController::class, 'couponApply'])->name('coupon.apply');

    Route::get('checkout', [CheckoutController::class, 'checkOut'])->name('checkout');
    Route::post('checkout/store', [CheckoutController::class, 'CheckoutPlaceOrderStore'])->name('checkout.store');
    Route::get('makePayment', [CheckoutController::class, 'makePayment'])->name('make.payment');
    Route::post('checkout/order/success', [CheckoutController::class, 'CheckoutOrderSuccess'])->name('checkout.order.success');

    Route::get('customer/register', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('customer/login', [CustomerController::class, 'custemerLogin'])->name('customer.login');
    Route::post('customer/authenticate', [CustomerController::class, 'login'])->name('customer.authenticate');
    Route::get('customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');
    Route::get('customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::post('customer/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('customer/address/update', [CustomerController::class, 'addressUpdate'])->name('customer.address.update');
    Route::get('customer/product/show/{id}', [CustomerController::class, 'customerProductShow'])->name('customer.product.show');

    Route::post('wishlist/store', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('wishlist/delete{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('/category/{urlkey}', [HomeController::class, 'category'])->name('categoryData');
    Route::get('/product/{urlkey}', [HomeController::class, 'product'])->name('productData');
   

    // ------------------------------------Ending route---------------------------------
    Route::get('/{urlkey}', [HomeController::class, 'page'])->name('page');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth','front_user']], function () {

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

    Route::get("enquiry", [EnquiryController::class, 'index'])->name('enquiry');
    Route::post("enquiry/status", [EnquiryController::class, 'status'])->name('enquiry.status');
    Route::delete("enquiry/destroy{id}", [EnquiryController::class, 'destroy'])->name('enquiry.destroy');

    Route::get('order', [ManageOrderController::class, 'index'])->name('order.index');
    Route::get('/order/show{id}', [ManageOrderController::class, 'show'])->name('order.show');
    Route::get('order/invoice/{id}', [ManageOrderController::class, 'generateInvoice'])->name('order.invoice');

    Route::get('customer', [ManageCustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/show{id}', [ManageCustomerController::class, 'show'])->name('customer.show');

});


Route::fallback(function () {
    return abort(404);
});