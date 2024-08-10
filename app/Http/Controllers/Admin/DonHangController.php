<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách đơn hàng";
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;
        $listDonHang = DonHang::query()->orderByDesc('id')->paginate(10);
        $typeHuyDonHang = DonHang::HUY_DON_HANG;
        return view('admins.donhangs.index', compact('title', 'listDonHang', 'trangThaiDonHang', 'trangThaiThanhToan', 'typeHuyDonHang'));
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Thông tin đơn hàng";

        $donHang = DonHang::query()->findOrFail($id);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;

        return view('admins.donhangs.show', compact('title', 'donHang', 'trangThaiDonHang', 'trangThaiThanhToan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);
        $currentTrangThai = $donHang->trang_thai_don_hang;
        $newTrangThai = $request->input('trang_thai_don_hang');

        $trangThai = array_keys(DonHang::TRANG_THAI_DON_HANG);

        // kiểm tra nếu đơn hàng đã hủy thì không được thay đổi trạng thái nữa

        if ($currentTrangThai === DonHang::HUY_DON_HANG) {
            return redirect()->route('admins.donhangs.index')->with('err', 'Đơn hàng đã bị hủy. Không thể cập nhật đơn hàng.');
        }

        // kiểm tra nếu trạng thái mới thì không được nằm sau trạng thái hiện tại
        if (array_search($newTrangThai, $trangThai) < array_search($currentTrangThai, $trangThai)) {
            return redirect()->route('admins.donhangs.index')->with('err', 'Không thể cập nhật ngược lại trạng thái.');
            
        }
        $donHang->trang_thai_don_hang = $newTrangThai;
        $donHang->save();

        return redirect()->route('admins.donhangs.index')->with('success', 'Cập nhật trạng thái thành công.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // khi người dùng đã hủy đơn hàng thì mới được xóa
        if ($request->isMethod('DELETE')) {
            $donHang = DonHang::query()->findOrFail($id);
            if ($donHang && $donHang->trang_thai_don_hang == DonHang::HUY_DON_HANG) {
                $donHang->chiTietDonHang()->delete();
                $donHang->delete();

                return redirect()->back()->with('success', 'Xóa đơn hàng thành công');
            }
            return redirect()->back()->with('err', 'Không thể xóa được đơn hàng');
            
        }

    }
}
