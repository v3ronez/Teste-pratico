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
    ->name('user.show');

Route::middleware(['adminOnly'])->prefix('admin')->group(function () {
    //Authentication Rotes
    //Password Reset
    $this->get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    $this->post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    $this->get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name(
        'password.reset'
    );
    $this->post('password/reset', [ResetPasswordController::class, 'reset']);


    Route::get('/home', 'HomeController@admin')->name('admin.home');
    //user
    Route::get('/user', [UserController::class, 'index'])
        ->name('admin.user.index');
    Route::get('/user/{id}', [UserController::class, 'show'])
        ->name('admin.user.show');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])
        ->name('admin.user.delete');

    //vehicle
    Route::get('/vehicle/new/{user_id}', [VehicleController::class, 'create'])->name('admin.vehicle.create');
    Route::post('/vehicle/{user_id}', [VehicleController::class, 'store'])->name('admin.vehicle.store');
    Route::get('/vehicle/{id}', [VehicleController::class, 'edit'])->name('admin.vehicle.edit');
    Route::put('/vehicle/{id}', [VehicleController::class, 'update'])->name('admin.vehicle.update');
});
