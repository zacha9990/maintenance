<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\FactoryController;

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



Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('factories')->group(function () {
        Route::get('/', [FactoryController::class, 'index'])->name('factories.index');
        Route::post('/', [FactoryController::class, 'store'])->name('factories.store');
        Route::get('/{id}', [FactoryController::class, 'show']);
        Route::put('/{id}', [FactoryController::class, 'update']);
        Route::delete('/{id}', [FactoryController::class, 'destroy'])->name('factories.destroy');
    });

    Route::resource('tools', ToolController::class);

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });
    Route::resource('changePassword', ChangePasswordController::class);
});

Route::get('/', [LoginController::class, 'showLoginForm']);


// Route::get('login', [LoginController::class, 'index'])->name('login');
// Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');
// Route::get('registration', [RegisterController::class, 'registration'])->name('register');
// Route::post('post-registration', [RegisterController::class, 'postRegistration'])->name('register.post');
// Route::get('logout', [LoginController::class, 'logout'])->name('logout');
