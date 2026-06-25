<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'ma_tai_khoan' => 'TK001',
                'ten_dang_nhap' => 'admin',
                'mat_khau' => Hash::make('admin123'),
                'ho_ten' => 'Quản Trị Viên',
                'email' => 'admin@bloodbank.com',
                'so_dien_thoai' => '0912345678',
                'vai_tro' => 'admin',
                'trang_thai' => 'active',
            ],
            [
                'ma_tai_khoan' => 'TK002',
                'ten_dang_nhap' => 'nhanvien1',
                'mat_khau' => Hash::make('nhanvien123'),
                'ho_ten' => 'Nguyễn Văn A',
                'email' => 'nhanvien1@bloodbank.com',
                'so_dien_thoai' => '0987654321',
                'vai_tro' => 'staff',
                'trang_thai' => 'active',
            ],
            [
                'ma_tai_khoan' => 'TK003',
                'ten_dang_nhap' => 'nhanvien2',
                'mat_khau' => Hash::make('nhanvien123'),
                'ho_ten' => 'Trần Thị B',
                'email' => 'nhanvien2@bloodbank.com',
                'so_dien_thoai' => '0909876543',
                'vai_tro' => 'staff',
                'trang_thai' => 'active',
            ],
        ];

        foreach ($accounts as $account) {
            TaiKhoan::create($account);
        }
    }
}
