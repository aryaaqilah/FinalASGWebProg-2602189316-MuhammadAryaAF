<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MutualController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ThumbController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('layout');
});


// Nama rute harus 'language'
// Route::get('/language/{lang}', [UserController::class, 'language'])->name('language');
// Route::get('lang/{locale}', function ($locale) {
//     if (in_array($locale, ['en', 'id'])) { // Add all supported languages here
//         session(['locale' => $locale]);
//         // app()->setLocale($locale);
//         App::setLocale($locale);
//     }
//     return redirect()->back();
// })->name('switch.language');

// Route::get('/detail/{id}', [BookController::class, 'detail'])->name('books.detail');

Route::get('/locale/{loc}', function ($loc) {
    Session::put('locale', $loc);
    return redirect()->back();
})->name('locale');


Route::resource('/register', UserController::class);
Route::get('/home', [UserController::class, 'index2'])->name('user.index2');

Route::get('/login', [AuthenticationController::class, 'index']);
Route::post('/login', [AuthenticationController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
// Route::get('/pay', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/pay', function () {
    // Pastikan Auth::user() mengembalikan instance dari Profile
    $user = Auth::user();

    // Jika user tidak ditemukan (misalnya belum login)
    if (!$user) {
        return redirect('/login')->withErrors('You need to log in first.');
    }

    // Ambil register_price dari user profile
    $price = $user->register_price;

    return view('pay', compact('price'));
})->name('pay');

Route::post('/updatePaid', [AuthenticationController::class, 'update_paid'])->name('updatePaid');

Route::get('/overpayment', [AuthenticationController::class, 'handleOverpayment'])->name('handle.overpayment');
Route::post('/overpayment', [AuthenticationController::class, 'processOverpayment'])->name('process.overpayment');

// Route::middleware(['auth', 'paid'])->group(function () {
//     Route::get('/', function () {
//         return view('home');
//     });

    Route::resource('user', UserController::class);
    Route::resource('friend-request', ThumbController::class);
    Route::resource('friend', MutualController::class);
    Route::resource('message', MessageController::class);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
// });

// Route::get('lang/{locale}', function ($locale) {
//     if (!in_array($locale, ['en', 'id'])) {
//         abort(400);
//     }

//     session(['locale' => $locale]);
//     return redirect()->back();
// })->name('lang.switch');

Route::post('/friend-request/accept/{id}', [ThumbController::class, 'accept'])->name('friend-request.accept');

Route::get('/notifications', function () {
    return view('notifications');
})->name('notifications.index');


Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show');
Route::post('/profile/add-balance', [UserController::class, 'addBalance'])->name('profile.addBalance');


Route::get('/avatars', [AvatarController::class, 'index'])->name('avatars.index');
Route::post('/avatars/purchase/{id}', [AvatarController::class, 'purchase'])->name('avatars.purchase');
