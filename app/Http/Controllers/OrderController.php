<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Models\DonHang;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\While_;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carts = session()->get('cart', []);
        if (!empty($carts)) {
            $total = 0;
            $subTotal = 0;
            $shipping = 25000;

            foreach ($carts as $item) {
                $subTotal += $item['gia'] * $item['so_luong'];
            }

            $total = $subTotal + $shipping;
            return view('clients.donhangs.create', compact('carts', 'subTotal', 'total', 'shipping'));
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
                // gửi mail khi đặt hàng thành công
                session()->put('cart', []);

                return redirect()->route('donhang.index')->with('suc', 'Đặt hàng thành công.');

                // dd($params);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
