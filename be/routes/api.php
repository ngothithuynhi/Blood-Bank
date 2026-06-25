<?php

use App\Http\Controllers\TaiKhoanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/dang-ky', [TaiKhoanController::class, 'dangKy']);
Route::get('/kich-hoat/{email}', [TaiKhoanController::class, 'kichHoat']);