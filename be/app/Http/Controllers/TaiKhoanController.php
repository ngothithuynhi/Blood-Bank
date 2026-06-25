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
}
