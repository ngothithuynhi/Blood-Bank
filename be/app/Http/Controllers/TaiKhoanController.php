<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taiKhoans = TaiKhoan::all();
        return response()->json($taiKhoans, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ma_tai_khoan' => 'required|unique:tai_khoans',
            'ten_dang_nhap' => 'required|unique:tai_khoans',
            'mat_khau' => 'required|min:6',
            'ho_ten' => 'required',
            'email' => 'required|email',
            'so_dien_thoai' => 'nullable',
            'vai_tro' => 'required',
            'trang_thai' => 'required',
        ]);

        $validated['mat_khau'] = Hash::make($validated['mat_khau']);

        $taiKhoan = TaiKhoan::create($validated);
        return response()->json($taiKhoan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $taiKhoan = TaiKhoan::find($id);

        if (!$taiKhoan) {
            return response()->json(['message' => 'Tài khoản không tìm thấy'], 404);
        }

        return response()->json($taiKhoan, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $taiKhoan = TaiKhoan::find($id);

        if (!$taiKhoan) {
            return response()->json(['message' => 'Tài khoản không tìm thấy'], 404);
        }

        $validated = $request->validate([
            'ten_dang_nhap' => 'unique:tai_khoans,ten_dang_nhap,' . $id . ',ma_tai_khoan',
            'mat_khau' => 'nullable|min:6',
            'ho_ten' => 'nullable',
            'email' => 'nullable|email',
            'so_dien_thoai' => 'nullable',
            'vai_tro' => 'nullable',
            'trang_thai' => 'nullable',
        ]);

        if (isset($validated['mat_khau'])) {
            $validated['mat_khau'] = Hash::make($validated['mat_khau']);
        } else {
            unset($validated['mat_khau']);
        }

        $taiKhoan->update($validated);
        return response()->json($taiKhoan, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $taiKhoan = TaiKhoan::find($id);

        if (!$taiKhoan) {
            return response()->json(['message' => 'Tài khoản không tìm thấy'], 404);
        }

        $taiKhoan->delete();
        return response()->json(['message' => 'Xóa tài khoản thành công'], 200);
    }

    // Đăng nhập cho user/admin
    public function dangNhap(Request $request)
    {
        $request->validate([
            'ten_dang_nhap' => 'required',
            'mat_khau' => 'required',
        ]);

        $taiKhoan = TaiKhoan::where('ten_dang_nhap', $request->ten_dang_nhap)->first();

        if (!$taiKhoan || !Hash::check($request->mat_khau, $taiKhoan->mat_khau)) {
            return response()->json([
                'status' => false,
                'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác'
            ]);
        }

        if ($taiKhoan->trang_thai !== 'active') {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản đã bị khóa'
            ]);
        }

        $token = $taiKhoan->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công',
            'token' => $token,
            'user' => $taiKhoan
        ]);
    }

    // Logout chung cho tất cả user/admin
    public function dangXuat(Request $request)
    {
        $user = $request->user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
            return response()->json([
                'status' => true,
                'message' => 'Đăng xuất thành công'
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Token không hợp lệ'], 401);
    }
}
