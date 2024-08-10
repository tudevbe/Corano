<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function listCart() {
        $cart = session()->get('cart', []);
        $total = 0;
        $subTotal = 0;
        $shipping = 25000;

        foreach($cart as $item) {
            $subTotal += $item['gia'] * $item['so_luong'];
        }
        
        $total = $subTotal + $shipping;

        return view('clients.giohang', compact('cart','subTotal','total','shipping'));
    }

    public function addCart(Request $request) {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $sanPham = SanPham::query()->findOrFail($productId);
        $gia = isset($sanPham->gia_khuyen_mai) ? $sanPham->gia_khuyen_mai : $sanPham->gia_san_pham;

        // Khởi tạo 1 mảng chứa thông tin giỏ hàng trên session
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Sản phẩm đã tồn tại trong giỏ hàng
            $cart[$productId]['so_luong'] += $quantity;
        }else {
            // Sản phẩm chưa có trong giỏ hàng
            $cart[$productId]= [
                'ten_san_pham' => $sanPham->ten_san_pham,
                'so_luong' => $quantity,
                'gia' => $gia,
                'hinh_anh' => $sanPham->hinh_anh,
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function updateCart(Request $request) {
        $cartNew = $request->input('cart', []);
        session()->put('cart', $cartNew);
        return redirect()->back();
    }
}
