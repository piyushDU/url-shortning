<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\URLController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [UserController::class, 'register']);
    Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserController::class, 'login']);
});
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [URLController::class, 'index'])->name('dashboard');
    Route::post('shorten-url', [URLController::class, 'shortenURL'])->name('shorten.url');
    Route::get('/url-list', [URLController::class, 'listURLs'])->name('urls.list');
    Route::get('urls/{id}/edit', [URLController::class, 'editURL'])->name('urls.edit');
    Route::put('urls/{id}', [URLController::class, 'updateURL'])->name('urls.update');
    Route::delete('urls/{id}', [URLController::class, 'deleteURL'])->name('urls.delete');
    Route::put('urls/{id}/{isActive}/deactivate', [URLController::class, 'deactivateURL'])->name('urls.deactivate');
    Route::get('/{id?}', [URLController::class, 'urls'])->name('urls');
});
// Route::get('/', function () {
//     return view('welcome');
// });
