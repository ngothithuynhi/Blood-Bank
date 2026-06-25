<?php

namespace App\Http\Controllers;

use App\Mail\MasterMail;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function dangKy(Request $request)
    {
        $maTaiKhoan = 'TK' . uniqid();

        DB::table('tai_khoans')->insert([
            'ma_tai_khoan'  => $maTaiKhoan,
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'mat_khau'      => Hash::make($request->password),
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'vai_tro'       => 'user',
            'trang_thai'    => 'inactive',
        ]);

        $noi_dung = [
            'ho_ten' => $request->ho_ten,
            'link'   => "http://127.0.0.1:8000/api/kich-hoat/" . urlencode($request->email),
        ];

        Mail::to($request->email)->send(new MasterMail(
            "Kích hoạt tài khoản",
            "kichhoat",
            $noi_dung
        ));

        return response()->json([
            'status' => true,
            'message' => 'Đăng ký thành công! Vui lòng kiểm tra email.'
        ]);
    }

    public function kichHoat($email)
    {
        $user = DB::table('tai_khoans')
            ->where('email', urldecode($email))
            ->first();

        if (!$user) {
            return redirect('http://localhost:5173/dang-nhap?active=fail');
        }

        DB::table('tai_khoans')
            ->where('email', urldecode($email))
            ->update([
                'trang_thai' => 'active'
            ]);

        return redirect('http://localhost:5173/dang-nhap?active=success');
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