<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaiKhoan extends Model
{
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

    public function khoMaus()
    {
        return $this->hasMany(KhoMau::class, 'ma_tai_khoan', 'ma_tai_khoan');
    }
}
