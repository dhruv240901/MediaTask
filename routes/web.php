<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\HomePage;
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

// Main Page Route
// Route::get('/', [HomePage::class, 'index'])->name('pages-home');
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('google/login', [GoogleAuthController::class, 'login'])->name('google-login');
Route::get('google/callback', [GoogleAuthController::class, 'callback'])->name('google-callback');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::prefix('user')->group(function(){
  Route::get('profile', [UserController::class, 'profile'])->name('user-profile');
  Route::get('editProfile', [UserController::class, 'editProfile'])->name('edit-user-profile');
  Route::post('updateProfile', [UserController::class, 'updateProfile'])->name('update-user-profile');
  Route::get('list', [UserController::class, 'index'])->name('user-list');

});

Route::prefix('video')->group(function(){
  Route::get('list', [VideoController::class, 'myVideos'])->name('my-videos');
  Route::get('shared', [VideoController::class, 'sharedVideos'])->name('shared-videos');
});
