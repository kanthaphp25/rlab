<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::post('/salesorderlist', [HomeController::class,'salesorder_list']);
Route::get('/salesorderlist', [HomeController::class,'salesorder_list']);

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */