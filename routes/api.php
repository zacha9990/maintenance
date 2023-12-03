<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\API\FactoryAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('users/{id}', [UserController::class, 'getUser'])->name('api.get_user');

Route::post('users-change-password/{id}', [UserController::class, 'changePassword'])->name('api.get_user');

Route::resource('factories', FactoryAPIController::Class, ['names' => 'api.factories']);