<?php

use App\Http\Controllers\TaiKhoanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    // Sửa lại URL và phương thức cho khớp hoàn toàn với FE và Controller
    Route::get('tai-khoan/get-data', [TaiKhoanController::class, 'getTaiKhoan']);
    Route::post('tai-khoan/them-tai-khoan', [TaiKhoanController::class, 'themTaiKhoan']);
    Route::post('tai-khoan/chi-tiet', [TaiKhoanController::class, 'chiTietTaiKhoan']);
    Route::post('tai-khoan/sua-tai-khoan', [TaiKhoanController::class, 'suaTaiKhoan']);
    Route::post('tai-khoan/xoa-tai-khoan', [TaiKhoanController::class, 'xoaTaiKhoan']);
    Route::post('tai-khoan/tim-kiem', [TaiKhoanController::class, 'timKiem']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/dang-ky', [TaiKhoanController::class, 'dangKy']);
Route::get('/kich-hoat/{email}', [TaiKhoanController::class, 'kichHoat']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
