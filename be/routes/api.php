<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaiKhoanController;

Route::post('/dang-nhap', [TaiKhoanController::class, 'dangNhap']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
