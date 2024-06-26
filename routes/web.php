<?php

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

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login', [LoginController::class, 'login']);

//user
Route::get('/user/{id}', [UserController::class, 'show'])
    ->middleware(['auth', 'myself'])
    ->name('user.show');

Route::get('/user/edit/{id}', [UserController::class, 'edit'])
    ->middleware(['auth', 'myself'])
    ->name('user.edit');

Route::put('/user/{id}', [UserController::class, 'update'])
    ->middleware(['auth', 'myself'])
    ->name('user.update');

Route::middleware(['adminOnly'])->prefix('admin')->group(function () {
    //Password Reset
    $this->get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    $this->post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    $this->get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name(
        'password.reset'
    );
    $this->post('password/reset', [ResetPasswordController::class, 'reset']);

    //home
    Route::get('/home', 'HomeController@admin')->name('admin.home');

    //user
    Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/new', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');

    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');

    //vehicle
    Route::get('/vehicle', [VehicleController::class, 'index'])->name('admin.vehicle.index');
    Route::get('/vehicle/new/{user_id}', [VehicleController::class, 'create'])->name('admin.vehicle.create');
    Route::post('/vehicle/{user_id}', [VehicleController::class, 'store'])->name('admin.vehicle.store');
    Route::get('/vehicle/{id}', [VehicleController::class, 'edit'])->name('admin.vehicle.edit');
    Route::put('/vehicle/{id}', [VehicleController::class, 'update'])->name('admin.vehicle.update');
    Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy'])->name('admin.vehicle.destroy');
});
