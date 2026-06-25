<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KhoMau;
use Carbon\Carbon;

class KhoMauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodInventory = [
            [
                'ma_kho_mau' => 'KM001',
                'nhom_mau' => 'O+',
                'so_luong' => 50,
                'muc_canh_bao' => 20,
                'trang_thai' => 'available',
                'vi_tri_luu_tru' => 'Kho A - Tủ 1',
                'han_su_dung' => Carbon::now()->addDays(30),
                'ghi_chu' => 'Máu O+ dự trữ chính',
                'ma_tai_khoan' => 'TK001',
            ],
            [
                'ma_kho_mau' => 'KM002',
                'nhom_mau' => 'A+',
                'so_luong' => 35,
                'muc_canh_bao' => 15,
                'trang_thai' => 'available',
                'vi_tri_luu_tru' => 'Kho A - Tủ 2',
                'han_su_dung' => Carbon::now()->addDays(25),
                'ghi_chu' => 'Máu A+ đủ',
                'ma_tai_khoan' => 'TK001',
            ],
            [
                'ma_kho_mau' => 'KM003',
                'nhom_mau' => 'B+',
                'so_luong' => 40,
                'muc_canh_bao' => 18,
                'trang_thai' => 'available',
                'vi_tri_luu_tru' => 'Kho A - Tủ 3',
                'han_su_dung' => Carbon::now()->addDays(28),
                'ghi_chu' => 'Máu B+ sẵn sàng',
                'ma_tai_khoan' => 'TK002',
            ],
            [
                'ma_kho_mau' => 'KM004',
                'nhom_mau' => 'AB+',
                'so_luong' => 15,
                'muc_canh_bao' => 10,
                'trang_thai' => 'warning',
                'vi_tri_luu_tru' => 'Kho B - Tủ 1',
                'han_su_dung' => Carbon::now()->addDays(20),
                'ghi_chu' => 'Máu AB+ hiếm, cần bổ sung',
                'ma_tai_khoan' => 'TK002',
            ],
            [
                'ma_kho_mau' => 'KM005',
                'nhom_mau' => 'O-',
                'so_luong' => 25,
                'muc_canh_bao' => 12,
                'trang_thai' => 'available',
                'vi_tri_luu_tru' => 'Kho B - Tủ 2',
                'han_su_dung' => Carbon::now()->addDays(32),
                'ghi_chu' => 'Máu O- dạo',
                'ma_tai_khoan' => 'TK003',
            ],
        ];

        foreach ($bloodInventory as $item) {
            KhoMau::create($item);
        }
    }
}
