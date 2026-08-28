<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. TRANG CHỦ
Route::get('/', function () {
    $products = \App\Models\Product::with('category')->latest()->get();
    return view('home', compact('products'));
})->name('home');

// 2. CHI TIẾT SẢN PHẨM
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// 3. TÀI KHOẢN & XÁC THỰC (AUTH)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('otp.view');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 4. GIỎ HÀNG (CART)
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
});

// 5. KHU VỰC QUẢN TRỊ (ADMIN)
Route::prefix('admin')->group(function () {
    
    // Quản lý Sản phẩm
    Route::resource('products', ProductController::class)->names([
        'index'   => 'admin.products.index',
        'create'  => 'admin.products.create',
        'store'   => 'admin.products.store',
        'show'    => 'admin.products.show',
        'edit'    => 'admin.products.edit',
        'update'  => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);

    // Quản lý Danh mục
    Route::resource('categories', CategoryController::class)->names([
        'index'   => 'categories.index',
        'create'  => 'admin.categories.create',
        'store'   => 'categories.store',
        'destroy' => 'categories.destroy',
    ]);
});