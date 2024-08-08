@extends('layouts.admin')


@section('title')
    {{ $title }}
@endsection


@section('css')
@endsection
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lí sản phẩm</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title align-content-center mb-0">{{ $title }}</h5>

                            <a href="{{ route('admins.sanphams.create') }}" class="btn btn-success"><i
                                    data-feather="plus-square"></i>Thêm sản phẩm</a>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Mã sản phẩm</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Danh mục</th>
                                            <th scope="col">Giá sản phẩm</th>
                                            <th scope="col">Giá khuyến mãi</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listSanPham as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $item->ma_san_pham }}</td>
                                                <td>{{ $item->ten_san_pham }}</td>
                                                <td><img src="{{ Storage::url($item->hinh_anh) }}" alt="Ảnh sản phẩm"
                                                        width="100px" height="50"></td>
                                                <td>{{ $item->danhMuc->ten_danh_muc }}</td>
                                                <td>{{ number_format($item->gia_san_pham)  }}</td>
                                                <td>{{ empty($item->gia_khuyen_mai) ? 0 : number_format($item->gia_khuyen_mai) }}</td>
                                                <td>{{ $item->so_luong }}</td>
                                                <td
                                                    class="{{ $item->trang_thai == true ? 'text-success' : 'text-danger' }}">
                                                    {{ $item->trang_thai == true ? 'Hiển thị' : 'Ẩn' }}</td>
                                                <td>
                                                    <a href="{{ route('admins.sanphams.edit', $item->id) }}"><i
                                                            class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>

                                                    <form action="{{ route('admins.sanphams.destroy', $item->id) }}"
                                                        method="post" class="d-inline"
                                                        onsubmit="return confirm('Bạn có chắc chắn không?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="border-0 bg-white"><i
                                                                class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $listSanPham->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- start row -->

        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection


@section('js')
@endsection
