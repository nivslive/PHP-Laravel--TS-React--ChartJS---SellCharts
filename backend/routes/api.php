<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/sells')->controller(SellController::class)->group(function() {
    Route::get('/all', 'get_all_sales_by_month');
    Route::get('/{month}/{year}', 'count_all_price_sells_by_period');
    // Route::get('/', 'count_all_price_sells_by_period');
});