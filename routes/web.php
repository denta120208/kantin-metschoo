<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\ShopController;
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/shop/buy/{product}', [ShopController::class, 'buy'])->name('shop.buy');
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/guest-login', function () {
    $user = User::firstOrCreate(
        ['email' => 'guest@kantin.com'],
        ['name' => 'Guest User', 'password' => bcrypt('guest123')]
    );
    Auth::login($user);
    return redirect()->route('shop');
})->name('guest.login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Berhasil logout');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::post('/shop/buy/{product}', [ShopController::class, 'buy'])->name('shop.buy');
});

