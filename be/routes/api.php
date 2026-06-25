<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\KhoMauController;

Route::post('/dang-nhap', [TaiKhoanController::class, 'dangNhap']);
Route::post('/dang-ky', [TaiKhoanController::class, 'dangKy']);
Route::get('/kich-hoat/{email}', [TaiKhoanController::class, 'kichHoat']);

Route::prefix('admin')->group(function () {
    Route::get('/tai-khoan/get-data', [TaiKhoanController::class, 'getTaiKhoan']);
    Route::post('/tai-khoan/them-tai-khoan', [TaiKhoanController::class, 'themTaiKhoan']);
    Route::post('/tai-khoan/chi-tiet', [TaiKhoanController::class, 'chiTietTaiKhoan']);
    Route::post('/tai-khoan/sua-tai-khoan', [TaiKhoanController::class, 'suaTaiKhoan']);
    Route::post('/tai-khoan/xoa-tai-khoan', [TaiKhoanController::class, 'xoaTaiKhoan']);
    Route::post('/tai-khoan/tim-kiem', [TaiKhoanController::class, 'timKiem']);

    Route::get('/nguoi-dung', [TaiKhoanController::class, 'index']);

    Route::get('/kho-mau', [KhoMauController::class, 'index']);
    Route::post('/kho-mau/them-kho-mau', [KhoMauController::class, 'store']);
    Route::post('/kho-mau/sua-kho-mau', [KhoMauController::class, 'update']);
    Route::post('/kho-mau/xoa-kho-mau', [KhoMauController::class, 'destroy']);
    Route::post('/kho-mau/tim-kiem', [KhoMauController::class, 'timKiem']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});