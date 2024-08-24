<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\MaKhuyenMai;
use App\Models\SanPham;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        return view('clients.home');
    }
    public function getAllSanPham() {
        $sanPham = SanPham::query()->get();
        $danhMuc = DanhMuc::query()->get();
        return view('clients.home', compact('sanPham', 'danhMuc'));
    }
    public function chiTietSanPham(string $id) {
        $sanPhamCT = SanPham::query()->findOrFail($id);
        $sanPham = SanPham::query()->get();
        $danhMuc = DanhMuc::query()->get();
        return view('clients.sanpham.product_detail', compact('sanPhamCT', 'sanPham', 'danhMuc'));
    }

    public function loadSanPhamDM ($id) {
        $sanPham = SanPham::query()->where('danh_muc_id', $id)->get();
        $danhMuc = DanhMuc::query()->get();
        $danhMucDetail = DanhMuc::query()->find($id);
        
        return view('clients.sanpham.sanpham_danhmuc', compact('sanPham', 'danhMuc', 'danhMucDetail'));
    }

    
}
