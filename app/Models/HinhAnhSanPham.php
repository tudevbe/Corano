<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HinhAnhSanPham extends Model
{
    use HasFactory;
    protected $fillable = [
        'hinh_anh',
        'san_pham_id',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class);
    }
}
