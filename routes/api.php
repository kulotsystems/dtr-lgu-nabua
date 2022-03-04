<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataStoreController;
use App\Http\Controllers\EmployeeController;

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

Route::post('/', [DataStoreController::class, 'store']);

Route::controller(EmployeeController::class)->group(function() {
    Route::post('employee/login'   , 'login');

    Route::post('employee/logout'  , 'logout');

    Route::get('employee/dashboard', 'dashboard')
        ->middleware('validate-account-code');
});
