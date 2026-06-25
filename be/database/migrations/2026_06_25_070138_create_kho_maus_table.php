<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kho_maus', function (Blueprint $table) {
            $table->string('ma_kho_mau')->primary();
            $table->string('nhom_mau');
            $table->integer('so_luong');
            $table->integer('muc_canh_bao');
            $table->string('trang_thai')->default('available');
            $table->string('vi_tri_luu_tru');
            $table->date('han_su_dung');
            $table->text('ghi_chu')->nullable();
            $table->string('ma_tai_khoan');
            $table->foreign('ma_tai_khoan')->references('ma_tai_khoan')->on('tai_khoans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kho_maus');
    }
};
