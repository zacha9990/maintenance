<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\VillagesController;
use App\Http\Controllers\SettlementAssetController;
use App\Http\Controllers\BspsController;
use App\Http\Controllers\DevelopmentProposalController;
use App\Http\Controllers\AssetHandoverController;
use App\Http\Controllers\RentalHouseController;
use App\Http\Controllers\DeveloperInfrastructureController;
use App\Http\Controllers\DeveloperApprovalController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\RlthController;
use App\Http\Controllers\LandingPage;
use App\Http\Controllers\ChangePasswordController;


use App\Http\Controllers\ToolController;

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

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);

    Route::resource('tools', ToolController::class);

    Route::get('/user/list', [App\Http\Controllers\UserController::class, 'list'])->name('user.list');
    Route::resource('users', UserController::class);

    Route::resource('changePassword', ChangePasswordController::class);

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/developer/list', [App\Http\Controllers\DeveloperController::class, 'list'])->name('developer.list');
    Route::resource('developer', DeveloperController::class);
  //  Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

    Route::group(['middleware' => ['role:Admin|Developer|SuperAdmin']], function(){

        Route::get('/developerApproval/list', [DeveloperApprovalController::class, 'list'])->name('developerApproval.list');

        Route::resource('developerApproval', DeveloperApprovalController::class);

        Route::post('assetHandover/reject/{assetHandover}', [AssetHandoverController::class, 'reject'])->name('assetHandover.reject');
        Route::get('assetHandover/list/{status}', [AssetHandoverController::class, 'list'])->name('assetHandover.list');
        Route::resource('assetHandover', AssetHandoverController::class);
    });

    Route::group(['middleware' => ['role:Admin|SuperAdmin']], function(){


        Route::get('/settlementAsset/list', [App\Http\Controllers\SettlementAssetController::class, 'list'])->name('settlementAsset.list');
        Route::resource('settlementAsset', SettlementAssetController::class);


        Route::get('developerApproval/reject{developerApproval}', [DeveloperApprovalController::class, 'reject'])->name('developerApproval.reject');
        Route::get('developerApproval/confirm/{developerApproval}/{confirm}', [DeveloperApprovalController::class, 'confirm'])->name('developerApproval.confirm');

        Route::get('/housings/export', [App\Http\Controllers\HousingController::class, 'export'])->name('housings.export');
        Route::get('/housings/list', [App\Http\Controllers\HousingController::class, 'list'])->name('housings.list');
        Route::get('/housings/list/{jenis}', [App\Http\Controllers\HousingController::class, 'listJenis'])->name('housings.list.jenis');
        Route::resource('housings', HousingController::class);

        Route::get('developmentProposal/confirm/{developmentProposal}/{confirm}', [DevelopmentProposalController::class, 'confirm'])->name('developmentProposal.confirm');

        Route::resource('developerInfrastructure', DeveloperInfrastructureController::class);

        Route::get('rlth/confirm/{rlth}/{confirm}', [RlthController::class, 'confirm'])->name('rlth.confirm');

        Route::get('assetHandover/confirm/{assetHandover}/{confirm}', [AssetHandoverController::class, 'confirm'])->name('assetHandover.confirm');
    });

    Route::group(['middleware' => ['role:Admin|Kecamatan|SuperAdmin']], function(){
        Route::post('developmentProposal/reject/{developmentProposal}', [DevelopmentProposalController::class, 'reject'])->name('developmentProposal.reject');
        Route::get('/developmentProposal/list', [DevelopmentProposalController::class, 'list'])->name('developmentProposal.list');
        Route::resource('developmentProposal', DevelopmentProposalController::class);

        Route::post('rlth/reject/{rlth}', [RlthController::class, 'reject'])->name('rlth.reject');
        Route::get('rlth/export', [RlthController::class, 'export'])->name('rlth.export');
        Route::get('rlth/list', [RlthController::class, 'list'])->name('rlth.list');
        Route::resource('rlth', RlthController::class);

        Route::get('bsps/document/{rtlh}', [BspsController::class, 'document'])->name('rlth.bsps.document');
        Route::resource('bsps', BspsController::class);



    });
    Route::resource('rentalHouse', RentalHouseController::class);
    Route::get('/district/select', [App\Http\Controllers\DistrictController::class, 'select'])->name('district.select');
    Route::get('/district/list', [App\Http\Controllers\DistrictController::class, 'list'])->name('district.list');
    Route::resource('district', DistrictController::class);

    Route::get('/villages/list', [App\Http\Controllers\VillagesController::class, 'list'])->name('villages.list');
    Route::get('/villages/select/{id}', [App\Http\Controllers\VillagesController::class, 'select'])->name('villages.select');

    Route::resource('villages', VillagesController::class);

});

Route::get('/', [LandingPage::class, 'index'])->name('landingPage');


// Route::get('login', [LoginController::class, 'index'])->name('login');
// Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');
// Route::get('registration', [RegisterController::class, 'registration'])->name('register');
// Route::post('post-registration', [RegisterController::class, 'postRegistration'])->name('register.post');
// Route::get('logout', [LoginController::class, 'logout'])->name('logout');
