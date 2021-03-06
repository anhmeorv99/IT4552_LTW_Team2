<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\MyController;


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

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('login', [CustomAuthController::class, 'customLogin'])->name('login.custom');

Route::get('/', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('file', [MyController::class, 'index'])->name('file');
Route::post('store', [MyController::class, 'store'])->name('store-file');

Route::get('admin', [MyController::class, 'admin'])->name('admin');
Route::get('destroy/{id}', [MyController::class, 'destroy'])->name('destroy');




