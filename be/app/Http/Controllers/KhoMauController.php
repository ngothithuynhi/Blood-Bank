<?php

namespace App\Http\Controllers;

use App\Models\KhoMau;
use Illuminate\Http\Request;

class KhoMauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $khoMaus = KhoMau::with('taiKhoan')->get();
        return response()->json($khoMaus, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ma_kho_mau' => 'required|unique:kho_maus',
            'nhom_mau' => 'required',
            'so_luong' => 'required|integer',
            'muc_canh_bao' => 'required|integer',
            'trang_thai' => 'required',
            'vi_tri_luu_tru' => 'required',
            'han_su_dung' => 'required|date',
            'ghi_chu' => 'nullable',
            'ma_tai_khoan' => 'required|exists:tai_khoans,ma_tai_khoan',
        ]);

        $khoMau = KhoMau::create($validated);
        return response()->json($khoMau, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $khoMau = KhoMau::with('taiKhoan')->find($id);
        
        if (!$khoMau) {
            return response()->json(['message' => 'Kho máu không tìm thấy'], 404);
        }

        return response()->json($khoMau, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $khoMau = KhoMau::find($id);
        
        if (!$khoMau) {
            return response()->json(['message' => 'Kho máu không tìm thấy'], 404);
        }

        $validated = $request->validate([
            'nhom_mau' => 'nullable',
            'so_luong' => 'nullable|integer',
            'muc_canh_bao' => 'nullable|integer',
            'trang_thai' => 'nullable',
            'vi_tri_luu_tru' => 'nullable',
            'han_su_dung' => 'nullable|date',
            'ghi_chu' => 'nullable',
            'ma_tai_khoan' => 'nullable|exists:tai_khoans,ma_tai_khoan',
        ]);

        $khoMau->update($validated);
        return response()->json($khoMau, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $khoMau = KhoMau::find($id);
        
        if (!$khoMau) {
            return response()->json(['message' => 'Kho máu không tìm thấy'], 404);
        }

        $khoMau->delete();
        return response()->json(['message' => 'Xóa kho máu thành công'], 200);
    }

    /**
     * Get blood inventory by blood group
     */
    public function getByBloodGroup($nhomMau)
    {
        $khoMaus = KhoMau::where('nhom_mau', $nhomMau)->get();
        return response()->json($khoMaus, 200);
    }

    /**
     * Get low stock warning items
     */
    public function getLowStock()
    {
        $khoMaus = KhoMau::whereRaw('so_luong <= muc_canh_bao')->get();
        return response()->json($khoMaus, 200);
    }
}
