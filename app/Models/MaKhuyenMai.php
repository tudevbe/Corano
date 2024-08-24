<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaKhuyenMai extends Model
{
    use HasFactory;

    protected $fillable = [
        'ma_khuyen_mai',
        'gia_tri',
        'so_luong',
        'so_lan_da_dung',
        'gia_tri_don_hang_toi_thieu',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'trang_thai'
    ];
}
