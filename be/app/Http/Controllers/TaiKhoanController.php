<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TaiKhoanController extends Controller
{
    // Danh sách tài khoản
    public function getTaiKhoan()
    {
        $data = TaiKhoan::all();

        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách tài khoản thành công',
            'data' => $data
        ]);
    }

    // Chi tiết tài khoản
    public function chiTietTaiKhoan(Request $request)
    {
        $data = TaiKhoan::find($request->ma_tai_khoan);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy tài khoản'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Thêm tài khoản
    public function themTaiKhoan(Request $request)
    {
        $taiKhoan = TaiKhoan::create([
            'ma_tai_khoan'  => $request->ma_tai_khoan,
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'mat_khau'      => Hash::make($request->mat_khau),
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'vai_tro'       => $request->vai_tro,
            'trang_thai'    => $request->trang_thai,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thêm tài khoản thành công',
            'data' => $taiKhoan
        ]);
    }

    // Sửa tài khoản
    public function suaTaiKhoan(Request $request)
    {
        $taiKhoan = TaiKhoan::find($request->ma_tai_khoan);

        if (!$taiKhoan) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy tài khoản'
            ]);
        }

        $taiKhoan->update([
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'vai_tro'       => $request->vai_tro,
            'trang_thai'    => $request->trang_thai,
        ]);

        if ($request->filled('mat_khau')) {
            $taiKhoan->update([
                'mat_khau' => Hash::make($request->mat_khau)
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật tài khoản thành công',
            'data' => $taiKhoan
        ]);
    }

    // Xóa tài khoản
    public function xoaTaiKhoan(Request $request)
    {
        $taiKhoan = TaiKhoan::find($request->ma_tai_khoan);

        if (!$taiKhoan) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy tài khoản'
            ]);
        }

        $taiKhoan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa tài khoản thành công'
        ]);
    }

    // Tìm kiếm
    public function timKiem(Request $request)
    {
        $keyword = $request->tim_kiem;

        $data = TaiKhoan::where('ho_ten', 'like', "%$keyword%")
            ->orWhere('email', 'like', "%$keyword%")
            ->orWhere('ten_dang_nhap', 'like', "%$keyword%")
            ->orWhere('so_dien_thoai', 'like', "%$keyword%")
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}