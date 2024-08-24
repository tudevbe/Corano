@extends('layouts.admin')


@section('title')
    {{ $title }}
@endsection


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lí Khuyến mãi</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title align-content-center mb-0">{{ $title }}</h5>

                            <a href="{{ route('admins.khuyenmais.create') }}" class="btn btn-success"><i
                                    data-feather="plus-square"></i>Tạo mã giảm giá</a>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{session('success')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-striped mb-0" id="example">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Mã khuyến mãi</th>
                                            <th scope="col">Giá trị</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Số lần đã dùng</th>
                                            <th scope="col">Giá trị đơn hàng tối thiểu</th>
                                            <th scope="col">Ngày tạo</th>
                                            <th scope="col">Ngày kết thúc</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maKhuyenMai as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $item->ma_khuyen_mai }}</td>
                                                <td>{{ $item->gia_tri }}</td>
                                                <td>{{ $item->so_luong }}</td>
                                                <td>{{ $item->so_lan_da_dung }}</td>
                                                <td>{{ $item->gia_tri_don_hang_toi_thieu }}</td>
                                                <td>{{ $item->ngay_bat_dau }}</td>
                                                <td>{{ $item->ngay_ket_thuc }}</td>
                    
                                                <td class="{{ $item->trang_thai == true ? 'text-success' : 'text-danger' }}">
                                                    {{ $item->trang_thai == true ? 'Đang hoạt động' : 'Đã hết hạn' }}</td>
                                                <td>
                                                    <a href="{{ route('admins.khuyenmais.edit', $item->id) }}"><i
                                                            class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>

                                                    <form action="{{ route('admins.khuyenmais.destroy', $item->id) }}"
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
