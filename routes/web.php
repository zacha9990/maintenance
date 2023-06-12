<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\ChangePasswordController;

use App\Http\Controllers\{
    UserController,
    Auth\LoginController,
    Auth\RegisterController,
    DashboardController,
    ToolController,
    FactoryController,
    MaintenanceController,
    ToolCategoryController,
    SparepartController,
    PositionController,
};


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

    Route::get('maintenances/{tool}/show', [MaintenanceController::class, 'show'])->name('maintenances.show');
    Route::get('maintenances/{tool}/create', [MaintenanceController::class, 'create'])->name('maintenances.create');
    Route::post('maintenances/{tool}/store', [MaintenanceController::class, 'store'])->name('maintenances.store');
    Route::get('maintenances/{tool}/edit', [MaintenanceController::class, 'edit'])->name('maintenances.edit');
    Route::put('maintenances/{tool}/update', [MaintenanceController::class, 'update'])->name('maintenances.update');


    Route::get('tools/list', [ToolController::class, 'list'])->name('tools.list');
    Route::get('tools/{tool}/spareparts', [ToolController::class, 'getToolSpareparts'])->name('tools.sparepart');
    Route::get('tools/{tool}/maintenance', [ToolController::class, 'getToolMaintenancePeriod'])->name('tools.maintenance');
    // Menampilkan semua maintenances
    Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');
    // Menampilkan jadwal maintenance hanya untuk user yang sedang login
    Route::get('/my-maintenances', [MaintenanceController::class, 'myMaintenances'])->name('maintenances.my');
    Route::get('/data', [MaintenanceController::class, 'getData'])->name('maintenances.data');
    Route::post('/maintenance/start', [MaintenanceController::class, 'startMaintenance'])->name('maintenance.start');
    Route::put('/maintenances/completeMaintenance/{id}', [MaintenanceController::class, 'completeMaintenance'])->name('maintenances.complete');


    Route::resource('tools', ToolController::class);

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });
    // Route::resource('changePassword', ChangePasswordController::class);

    Route::get('spareparts/list', [SparepartController::class, 'list'])->name('spareparts.list');
    Route::resource('spareparts', SparepartController::class);

    Route::get('users/getUsers', [UserController::class, 'getUsers'])->name('users.getUsers');
    Route::resource('users', UserController::class);

    Route::get('positions/getData', [PositionController::class, 'getData'])->name('positions.getData');
    Route::resource('positions', PositionController::class);
});

Route::get('/', [LoginController::class, 'showLoginForm']);


// Route::get('login', [LoginController::class, 'index'])->name('login');
// Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');
// Route::get('registration', [RegisterController::class, 'registration'])->name('register');
// Route::post('post-registration', [RegisterController::class, 'postRegistration'])->name('register.post');
// Route::get('logout', [LoginController::class, 'logout'])->name('logout');
