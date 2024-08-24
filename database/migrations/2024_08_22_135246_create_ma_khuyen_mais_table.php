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
        Schema::create('ma_khuyen_mais', function (Blueprint $table) {
            $table->id();
            $table->string('ma_khuyen_mai',255);
            $table->decimal('gia_tri',12,2);
            $table->integer('so_luong');
            $table->integer('so_lan_da_dung')->default(0);
            $table->decimal('gia_tri_don_hang_toi_thieu', 12,2)->default(0);
            $table->dateTime('ngay_bat_dau');
            $table->dateTime('ngay_ket_thuc')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_khuyen_mais');
    }
};
