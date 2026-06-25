<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\KhoMauController;

Route::post('/dang-nhap', [TaiKhoanController::class, 'dangNhap']);

Route::middleware('auth:sanctum')->group(function () {
Route::get('/user', function (Request $request) {
    return $request->user();
});



    // Admin - Nguoi dung routes
    Route::get('/admin/nguoi-dung', [TaiKhoanController::class, 'index']);

    // Admin - Kho mau routes
    Route::get('/admin/kho-mau', [KhoMauController::class, 'index']);
    Route::post('/admin/kho-mau/them-kho-mau', [KhoMauController::class, 'store']);
    Route::post('/admin/kho-mau/sua-kho-mau', [KhoMauController::class, 'update']);
    Route::post('/admin/kho-mau/xoa-kho-mau', [KhoMauController::class, 'destroy']);
    Route::post('/admin/kho-mau/tim-kiem', [KhoMauController::class, 'timKiem']);
});
