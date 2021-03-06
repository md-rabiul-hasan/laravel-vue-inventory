<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route:: post('login', [AuthController::class, 'login']);
    Route:: post('signup', [AuthController::class, 'signup']);
    Route:: post('logout', [AuthController::class, 'logout']);
    Route:: post('refresh', [AuthController::class, 'refresh']);
    Route:: post('me', [AuthController::class, 'me']);

});

Route::resource('employee', EmployeeController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);