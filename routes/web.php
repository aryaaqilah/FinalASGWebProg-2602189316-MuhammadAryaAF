<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MutualController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ThumbController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout');
});

// Route::get('/detail/{id}', [BookController::class, 'detail'])->name('books.detail');

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
