<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\ToolCategoryController;

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

    Route::prefix('tool_categories')->group(function () {
        Route::get('/', [ToolCategoryController::class, 'index'])->name('tool_categories.index');
        Route::get('/datatables', [ToolCategoryController::class, 'datatable'])->name('tool_categories.datatables');
        Route::post('/', [ToolCategoryController::class, 'store'])->name('tool_categories.store');
        Route::put('/{tool_category}', [ToolCategoryController::class, 'update'])->name('tool_categories.update');
        Route::delete('/{tool_category}', [ToolCategoryController::class, 'destroy'])->name('tool_categories.destroy');
    });



    Route::get('tools/list', [ToolController::class, 'list'])->name('tools.list');
    Route::get('tools/{tool}/spareparts', [ToolController::class, 'getToolSpareparts'])->name('tools.sparepart');
    Route::get('tools/{tool}/maintenance', [ToolController::class, 'getToolMaintenancePeriod'])->name('tools.maintenance');
    Route::resource('tools', ToolController::class);

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });
    // Route::resource('changePassword', ChangePasswordController::class);
});

Route::get('/', [LoginController::class, 'showLoginForm']);


// Route::get('login', [LoginController::class, 'index'])->name('login');
// Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');
// Route::get('registration', [RegisterController::class, 'registration'])->name('register');
// Route::post('post-registration', [RegisterController::class, 'postRegistration'])->name('register.post');
// Route::get('logout', [LoginController::class, 'logout'])->name('logout');
