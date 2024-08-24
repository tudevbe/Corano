<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaKhuyenMai;
use Illuminate\Http\Request;

class MaKhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách khuyến mãi';
        $maKhuyenMai = MaKhuyenMai::query()->get();
        return view('admins.khuyenmais.index', compact('maKhuyenMai', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tạo mã khuyến mãi';
        return view('admins.khuyenmais.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            MaKhuyenMai::query()->create($params);
            return redirect()->route('admins.khuyenmais.index')->with('success', 'Thêm thành công');
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
        $maKhuyenMai = MaKhuyenMai::query()->find($id);
        $title = 'Sửa mã khuyễn mãi';
        return view('admins.khuyenmais.edit', compact('title', 'maKhuyenMai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $maKhuyenMai = MaKhuyenMai::query()->find($id);
            $maKhuyenMai->update($params);
            return redirect()->route('admins.khuyenmais.index')->with('success', 'Sửa thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $maKhuyenMai = MaKhuyenMai::query()->find($id);
        $maKhuyenMai->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
