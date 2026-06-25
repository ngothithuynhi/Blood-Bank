<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhoMau extends Model
{
    protected $primaryKey = 'ma_kho_mau';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ma_kho_mau',
        'nhom_mau',
        'so_luong',
        'muc_canh_bao',
        'trang_thai',
        'vi_tri_luu_tru',
        'han_su_dung',
        'ghi_chu',
        'ma_tai_khoan',
    ];

    protected $dates = [
        'han_su_dung',
        'created_at',
        'updated_at',
    ];

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'ma_tai_khoan', 'ma_tai_khoan');
    }
}
