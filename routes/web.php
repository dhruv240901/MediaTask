<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;

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

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('google/login', [GoogleAuthController::class, 'login'])->name('google-login');
Route::get('google/callback', [GoogleAuthController::class, 'callback'])->name('google-callback');

Route::middleware('auth')->group(function () {
  Route::get('/', [HomeController::class, 'index'])->name('index');

  // User Routes
  Route::prefix('user')->group(function () {
    Route::get('profile', [UserController::class, 'profile'])->name('user-profile');
    Route::get('list', [UserController::class, 'index'])->name('user-list');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user-edit');
    Route::put('update/{id}', [UserController::class, 'update'])->name('user-update');
    Route::post('updateStatus', [UserController::class, 'updateStatus'])->name('update-user-status');
    Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('user-delete');
  });

  // Video Routes
  Route::prefix('video')->group(function () {
    Route::get('list', [VideoController::class, 'myVideos'])->name('my-videos');
    Route::get('create', [VideoController::class, 'addEdit'])->name('add-videos');
    Route::post('store', [VideoController::class, 'storeUpdate'])->name('store-videos');
    Route::get('edit/{id}', [VideoController::class, 'addEdit'])->name('edit-video');
    Route::put('update/{id}', [VideoController::class, 'storeUpdate'])->name('update-video');
    Route::delete('delete/{id}', [VideoController::class, 'destroy'])->name('delete-video');
    Route::post('shareVideo', [VideoController::class, 'shareVideo'])->name('share-video');
    Route::get('shared', [VideoController::class, 'sharedVideos'])->name('shared-videos');

  });
});

Route::fallback(function () {
  return view('error.pageNotFound');
});

