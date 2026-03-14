<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Temporary Password Reset Route (REMOVE AFTER USE!)
|--------------------------------------------------------------------------
*/
Route::get('/reset-admin-password', function () {
    $user = \App\Models\User::where('email', 'admin@gardibazzar.com')->first();
    if ($user) {
        $user->password = \Illuminate\Support\Facades\Hash::make('password123');
        $user->save();
        return 'Admin password has been reset! Email: admin@gardibazzar.com | Password: password123';
    }
    return 'Admin user not found!';
});

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/products', [FrontController::class, 'products'])->name('products');
Route::get('/products/{product}', [FrontController::class, 'productDetail'])->name('product.detail');
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::post('/cart/add', [FrontController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [FrontController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remove/{id}', [FrontController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [FrontController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [FrontController::class, 'placeOrder'])->name('checkout.place');
Route::get('/order-success/{order}', [FrontController::class, 'orderSuccess'])->name('order.success');
Route::get('/track', [FrontController::class, 'track'])->name('track');
Route::post('/track', [FrontController::class, 'trackResult'])->name('track.result');
Route::get('/about', [FrontController::class, 'about'])->name('about');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');

    Route::get('/sliders', [SliderController::class, 'index'])->name('admin.sliders');
    Route::get('/sliders/create', [SliderController::class, 'create'])->name('admin.sliders.create');
    Route::post('/sliders', [SliderController::class, 'store'])->name('admin.sliders.store');
    Route::get('/sliders/{slider}/edit', [SliderController::class, 'edit'])->name('admin.sliders.edit');
    Route::put('/sliders/{slider}', [SliderController::class, 'update'])->name('admin.sliders.update');
    Route::delete('/sliders/{slider}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');

    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
});
