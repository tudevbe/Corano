<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Mail\OrderConfirm;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\While_;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $danhMuc = DanhMuc::query()->get();
        $donHangs = Auth::user()->donHang;
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $typeChoXacNhan = DonHang::CHO_XAC_NHAN;
        $typeDangVanChuyen = DonHang::DANG_VAN_CHUYEN;
        $typeDaXacNhan = DonHang::DA_XAC_NHAN;
        $typeDangChuanBi = DonHang::DANG_CHUAN_BI;
        return view('clients.donhangs.index', compact('danhMuc', 'donHangs', 'trangThaiDonHang', 'typeChoXacNhan', 'typeDangVanChuyen', 'typeDaXacNhan', 'typeDangChuanBi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhMuc = DanhMuc::query()->get();
        $carts = session()->get('cart', []);
        if (!empty($carts)) {
            $total = 0;
            $subTotal = 0;
            $shipping = 25000;

            foreach ($carts as $item) {
                $subTotal += $item['gia'] * $item['so_luong'];
            }

            $total = $subTotal + $shipping;
            return view('clients.donhangs.create', compact('danhMuc', 'carts', 'subTotal', 'total', 'shipping'));
        }
        return redirect()->route('cart.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        // dd($request->all());
        if ($request->isMethod('POST')) {
            DB::beginTransaction();
            try {
                $params = $request->except('_token');
                $params['ma_don_hang'] = $this->generateUniqueOrderCode();

                $donHang = DonHang::query()->create($params);
                $donHangId = $donHang->id;

                $carts = session()->get('cart', []);
                
                foreach ($carts as $key => $item) {
                    $thanhTien = $item['gia'] * $item['so_luong'];

                    $donHang->chiTietDonHang()->create([
                        'don_hang_id' => $donHangId,
                        'san_pham_id' => $key,
                        'don_gia' => $item['gia'],
                        'so_luong' => $item['so_luong'],
                        'thanh_tien' => $thanhTien,
                    ]);
                }

                DB::commit();


                // khi thêm thành công sẽ thực hiện các công việc dưới đây
                // trừ đi số lượng của sản phẩm
                foreach ($donHang->chiTietDonHang as $value) {
                    $sanPham = SanPham::query()->findOrFail($value->san_pham_id);
                    $sanPham->so_luong -= $value->so_luong;
                    $sanPham->save();
                }
                // gửi mail khi đặt hàng thành công
                Mail::to($donHang->email_nguoi_nhan)->queue(new OrderConfirm($donHang));

                session()->put('cart', []);

                return redirect()->route('donhang.index')->with('suc', 'Đặt hàng thành công.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('err', 'Có lỗi khi đặt hàng. Kiểm tra lại thông tin đơn hàng.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $danhMuc = DanhMuc::query()->get();
        $donHang = DonHang::query()->findOrFail($id);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;

        return view('clients.donhangs.show', compact('danhMuc', 'donHang', 'trangThaiDonHang', 'trangThaiThanhToan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);
        DB::beginTransaction();

        try {
            if ($request->has('huy_don_hang')) {
                $donHang->update(['trang_thai_don_hang' => DonHang::HUY_DON_HANG]);
            } elseif ($request->has('da_giao_hang')) {
                $donHang->update(['trang_thai_don_hang' => DonHang::DA_GIAO_HANG]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generateUniqueOrderCode()
    {
        do {
            $orderCode = 'ORD-' . Auth::id() . '-' . now()->timestamp;
        } while (DonHang::where('ma_don_hang', $orderCode)->exists());

        return $orderCode;
    }
}
