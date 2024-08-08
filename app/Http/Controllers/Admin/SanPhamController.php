<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use App\Mail\MailConfirm;
use App\Models\DanhMuc;
use App\Models\HinhAnhSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách sản phẩm";
        $listSanPham = SanPham::query()->orderByDesc('id')->paginate(5);
        return view('admins.sanphams.index', compact('title', 'listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm sản phẩm";
        $listDanhMuc = DanhMuc::query()->get();
        return view('admins.sanphams.create', compact('title', 'listDanhMuc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSanPhamRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');

            // chuyển đổi giá trị checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            // xử lí hình ảnh đại diện

            if ($request->hasFile('hinh_anh')) {
                $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $params['hinh_anh'] = null;
            }

            // thêm sản phẩm

            $sanPham = SanPham::query()->create($params);
            // sau khi thêm sản phẩm thành công
            //thì gửi mail và kèm theo thông báo

            // Mail::to('tunvph36486@fpt.edu.vn')->send(new MailConfirm($sanPham));

            // lấy id sản phẩm vừa thêm để thêm được album

            $sanPhamId = $sanPham->id;

            // xử lí thêm Album

            if ($request->hasFile('list_hinh_anh')) {
                foreach ($request->file('list_hinh_anh') as $image) {
                    if ($image) {
                        $path = $image->store('uploads/hinhanhsanpham/id_' . $sanPhamId, 'public');
                        $sanPham->hinhAnhSanPham()->create(
                            [
                                'san_pham_id' => $sanPhamId,
                                'hinh_anh' => $path,
                            ]
                        );
                    }
                }
            }
            return redirect()->route('admins.sanphams.index')->with('success', 'Thêm sản phẩm thành công');
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
        $title = "Cập nhật thông tin sản phẩm";
        $listDanhMuc = DanhMuc::query()->get();
        $sanPham = SanPham::query()->findOrFail($id);
        return view('admins.sanphams.update', compact('title', 'listDanhMuc', 'sanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSanPhamRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');

            $sanPham = SanPham::query()->findOrFail($id);

            // chuyển đổi giá trị checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            // xử lí hình ảnh đại diện

            if ($request->hasFile('hinh_anh')) {
                if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
                    Storage::disk('public')->delete($sanPham->hinh_anh);
                }
                $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $params['hinh_anh'] = $sanPham->hinh_anh;
            }

            // xử lí album


            $currentimages = $sanPham->hinhAnhSanPham->pluck('id')->toArray();
            $arrayCombine = array_combine($currentimages, $currentimages);

            // Trường hợp xóa ảnh trong album
            foreach ($arrayCombine as $key => $value) {
                // Tìm kiếm id hình ảnh trong mảng hình ảnh mới đẩy lên
                // Nếu k tồn tại id tức là ng dùng đã xóa
                if (!array_key_exists($key, $request->list_hinh_anh)) {
                    $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);
                    // xóa hình ảnh
                    if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                        Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                        $hinhAnhSanPham->delete();
                    }
                }
            }
            foreach ($request->list_hinh_anh as $key => $image) {
                // Trường hợp thêm mới hình ảnh
                if (!array_key_exists($key, $arrayCombine)) {
                    if ($request->hasFile("list_hinh_anh.$key")) {
                        $path = $image->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                        $sanPham->hinhAnhSanPham()->create([
                            'san_pham_id' => $id,
                            'hinh_anh' => $path,
                        ]);
                    }
                } else {
                    // Trường hợp thay đổi hình ảnh
                    if ($request->hasFile("list_hinh_anh.$key")) {
                        $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);
                        if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                            Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                        }
                        $path = $image->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                        if ($hinhAnhSanPham) {
                            $hinhAnhSanPham->update([
                                'hinh_anh' => $path,
                            ]);
                        }
                    }
                }
            }


            $sanPham->update($params);
            return redirect()->route('admins.sanphams.index')->with('success', 'Cập nhật thông tin sản phẩm thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->isMethod('DELETE')) {
            $sanPham = SanPham::query()->findOrFail($id);

            // xóa hình ảnh đại diện của sản phẩm
            if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
                Storage::disk('public')->delete($sanPham->hinh_anh);
            }

            // Xóa album ảnh sản phẩm
            $sanPham->hinhAnhSanPham()->delete();

            // xóa toàn bộ ảnh trong thư mục
            $path = 'uploads/hinhanhsanpham/id_' . $id;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->deleteDirectory($path);
            }

            $sanPham->delete();

            return redirect()->route('admins.sanphams.index')->with('success', 'Xóa sản phẩm thành công');
        }
    }
}
