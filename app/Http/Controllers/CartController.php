<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\MaKhuyenMai;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function listCart(Request $request)
    {
        $danhMuc = DanhMuc::all();
        $cart = session()->get('cart', []);
        $total = 0;
        $subTotal = 0;
        $shipping = 25000;
        foreach ($cart as $item) {
            $subTotal += $item['gia'] * $item['so_luong'];
        }
    
        $total = ($subTotal + $shipping);
    
        return view('clients.giohang', compact('cart', 'subTotal', 'total', 'shipping', 'danhMuc'));
    }
    

    public function addCart(Request $request)
    {
        $danhMuc = DanhMuc::query()->get();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $sanPham = SanPham::query()->findOrFail($productId);
        $gia = isset($sanPham->gia_khuyen_mai) ? $sanPham->gia_khuyen_mai : $sanPham->gia_san_pham;

        $sanPham = SanPham::query()->findOrFail($productId);
        if ($quantity > $sanPham->so_luong) {
            return redirect()->back()->with('err', 'Số lượng sản phẩm của chúng tôi không đủ.');
        } else {
            // Khởi tạo 1 mảng chứa thông tin giỏ hàng trên session
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                // Sản phẩm đã tồn tại trong giỏ hàng
                if ($cart[$productId]['so_luong'] + $quantity > $sanPham->so_luong) {
                    return redirect()->back()->with('err', "Số lượng sản phẩm: $sanPham->ten_san_pham bạn thêm vào giỏ hàng lớn hơn số lượng chúng tôi đang có.");
                } else {
                    $cart[$productId]['so_luong'] += $quantity;
                }
            } else {
                // Sản phẩm chưa có trong giỏ hàng
                $cart[$productId] = [
                    'ten_san_pham' => $sanPham->ten_san_pham,
                    'so_luong' => $quantity,
                    'gia' => $gia,
                    'hinh_anh' => $sanPham->hinh_anh,
                ];
            }
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        $cartNew = $request->input('cart', []);
        $sanPham = SanPham::query()->get();
        foreach ($cartNew as $key => $value) {
            foreach ($sanPham as $item) {
                if ($key == $item->id) {
                    if ($item->so_luong < $value['so_luong']) {
                        return redirect()->back()->with('err', "'Mã sản phẩm: ' . $item->ten_san_pham . 'của chúng tội hiện tại không đủ số lượng bạn mong muốn.'");
                    }
                }
            }
        }
        session()->put('cart', $cartNew);
        return redirect()->back();
    }
}
