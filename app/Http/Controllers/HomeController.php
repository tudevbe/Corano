<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
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

        return view('clients.home', compact('sanPham'));
    }

    public function chiTietSanPham(string $id) {
        $sanPhamCT = SanPham::query()->findOrFail($id);
        $sanPham = SanPham::query()->get();

        return view('clients.sanpham.product_detail', compact('sanPhamCT', 'sanPham'));
    }
}
