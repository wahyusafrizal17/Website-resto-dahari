<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', function () {
//     return view('website.welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/all-menu', [App\Http\Controllers\MenuController::class, 'website'])->name('website.menu');

Route::get('/auth-login', function () {
    return view('website.login');
});

Route::get('/auth-register', function () {
    return view('website.register');
});

Route::post('new-login', [App\Http\Controllers\HomeController::class, 'login'])->name('new-login');
Route::get('new-logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('new-logout');

Route::get('/pesanan', [App\Http\Controllers\TransaksiController::class, 'pesanan'])->name('website.pesanan');
Route::get('/keranjang', [App\Http\Controllers\TransaksiController::class, 'keranjang'])->name('website.keranjang');
Route::get('/keranjang/{id}/add', [App\Http\Controllers\TransaksiController::class, 'keranjangAdd'])->name('website.keranjang.add');
Route::get('/keranjang/{id}/delete', [App\Http\Controllers\TransaksiController::class, 'keranjangDelete'])->name('website.keranjang.delete');

Route::get('/keranjang/checkout', [App\Http\Controllers\TransaksiController::class, 'keranjangCheckout'])->name('website.checkout');
Route::post('/keranjang/checkout/pembayaran', [App\Http\Controllers\TransaksiController::class, 'pembayaran'])->name('website.pembayaran');
Route::get('/pembayaran/{id}/success', [App\Http\Controllers\TransaksiController::class, 'success'])->name('website.success');

Route::get('/reservasi', [App\Http\Controllers\ReservasiController::class, 'reservasi'])->name('website.reservasi');
Route::get('admin/reservasi', [App\Http\Controllers\ReservasiController::class, 'admin'])->name('admin.reservasi');
// Route::resource('admin/reservasi', 'App\Http\Controllers\ReservasiController');
Route::post('admin/reservasi/delete', 'App\Http\Controllers\ReservasiController@delete')->name('admin.reservasi.delete');

Route::middleware(['authadmin'])->group(function () {

    Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

        Route::resource('menu', 'App\Http\Controllers\MenuController');
        Route::post('menu/delete', 'App\Http\Controllers\MenuController@delete')->name('menu.delete');

        Route::resource('meja', 'App\Http\Controllers\MejaController');
        Route::post('meja/delete', 'App\Http\Controllers\MejaController@delete')->name('meja.delete');

        Route::resource('kategori', 'App\Http\Controllers\KategoriController');
        Route::post('kategori/delete', 'App\Http\Controllers\KategoriController@delete')->name('kategori.delete');

        Route::resource('diskon', 'App\Http\Controllers\DiskonController');
        Route::post('diskon/delete', 'App\Http\Controllers\DiskonController@delete')->name('diskon.delete');

        Route::get('transaksi', 'App\Http\Controllers\TransaksiController@index')->name('transaksi.index');
        Route::get('transaksi/export', 'App\Http\Controllers\TransaksiController@export')->name('transaksi.export');

        Route::resource('user', 'App\Http\Controllers\UserController');
        Route::post('user/delete', 'App\Http\Controllers\UserController@delete')->name('user.delete');


    });
});