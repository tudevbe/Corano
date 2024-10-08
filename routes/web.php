<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\MaKhuyenMaiController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\SanPhamController as UserSanPhamController;

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

Auth::routes();
// Route Client


// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'getAllSanPham'])->name('home');
Route::get('/danh-muc/{id}', [HomeController::class, 'loadSanPhamDM'])->name('danh_muc');
Route::get('/product/detail/{id}', [HomeController::class, 'chiTietSanPham'])->name('products.detail');

// Route giỏ hàng
Route::prefix('cart')
    ->as('cart.')
    ->group(function () {
        Route::get('/list-cart', [CartController::class, 'listCart'])->name('list');
        Route::post('/add-to-cart', [CartController::class, 'addCart'])->name('add');
        Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update');
    });

// Route đơn hàng
Route::middleware('auth')->prefix('donhang')
    ->as('donhang.')
    ->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/store', [OrderController::class, 'store'])->name('store');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
        Route::put('{id}/update', [OrderController::class, 'update'])->name('update');
    });


// Route ADMIN
Route::get('/admin', function () {
    return view('layouts.admin');
})->name('admin');
Route::middleware(['auth', 'auth.admin'])->prefix('admins')
    ->as('admins.')
    ->group(function () {

        // Route danh mục
        Route::prefix('danhmucs')
            ->as('danhmucs.')
            ->group(function () {
                Route::get('/', [DanhMucController::class, 'index'])->name('index');
                Route::get('/create', [DanhMucController::class, 'create'])->name('create');
                Route::post('/store', [DanhMucController::class, 'store'])->name('store');
                Route::get('/show/{id}', [DanhMucController::class, 'show'])->name('show');
                Route::get('{id}/edit', [DanhMucController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [DanhMucController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [DanhMucController::class, 'destroy'])->name('destroy');
            });

        //Route sản phẩm
        Route::prefix('sanphams')
            ->as('sanphams.')
            ->group(function () {
                Route::get('/', [SanPhamController::class, 'index'])->name('index');
                Route::get('/create', [SanPhamController::class, 'create'])->name('create');
                Route::post('/store', [SanPhamController::class, 'store'])->name('store');
                Route::get('/show/{id}', [SanPhamController::class, 'show'])->name('show');
                Route::get('{id}/edit', [SanPhamController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [SanPhamController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [SanPhamController::class, 'destroy'])->name('destroy');
            });

        //Route Đơn hàng
        Route::prefix('donhangs')
            ->as('donhangs.')
            ->group(function () {
                Route::get('/', [DonHangController::class, 'index'])->name('index');
                Route::get('/show/{id}', [DonHangController::class, 'show'])->name('show');
                Route::put('{id}/update', [DonHangController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [DonHangController::class, 'destroy'])->name('destroy');
            });

        // Route Khuyến mãi
        Route::prefix('khuyenmais')
            ->as('khuyenmais.')
            ->group(function () {
                Route::get('/', [MaKhuyenMaiController::class, 'index'])->name('index');
                Route::get('/create', [MaKhuyenMaiController::class, 'create'])->name('create');
                Route::post('/store', [MaKhuyenMaiController::class, 'store'])->name('store');
                Route::get('/show/{id}', [MaKhuyenMaiController::class, 'show'])->name('show');
                Route::get('{id}/edit', [MaKhuyenMaiController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [MaKhuyenMaiController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [MaKhuyenMaiController::class, 'destroy'])->name('destroy');
            });
    });
