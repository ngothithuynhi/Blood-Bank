<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class TaiKhoan extends Authenticatable
{
    use HasApiTokens;

    protected $primaryKey = 'ma_tai_khoan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ma_tai_khoan',
        'ten_dang_nhap',
        'mat_khau',
        'ho_ten',
        'email',
        'so_dien_thoai',
        'vai_tro',
        'trang_thai',
    ];

    protected $hidden = [
        'mat_khau',
    ];

    protected $appends = ['id_chuc_vu'];

    public function getIdChucVuAttribute()
    {
        if ($this->vai_tro === 'admin') {
            return 1;
        } elseif ($this->vai_tro === 'staff') {
            return 2;
        }
        return 3;
    }

    public function khoMaus()
    {
        return $this->hasMany(KhoMau::class, 'ma_tai_khoan', 'ma_tai_khoan');
    }
}
