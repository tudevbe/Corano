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
                    <h4 class="fs-18 fw-semibold m-0">Quản lí danh sách đơn hàng</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title align-content-center mb-0">{{ $title }}</h5>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('err'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('err') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Ngày đặt</th>
                                            <th>Tổng tiền</th>
                                            <th>Thanh toán</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listDonHang as $item)
                                            <tr>
                                                <th>
                                                    {{ $item->ma_don_hang }}
                                                </th>
                                                <td>
                                                    {{ $item->created_at->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    {{ number_format($item->tong_tien, 0, '', '.') }} đ
                                                </td>
                                                <td>
                                                    {{ $trangThaiThanhToan[$item->trang_thai_thanh_toan] }}
                                                </td>
                                                <td>
                                                    @if ($item->trang_thai_don_hang == $typeHuyDonHang)
                                                        {{ $trangThaiDonHang[$item->trang_thai_don_hang] }}
                                                    @else
                                                        <form action="{{ route('admins.donhangs.update', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="trang_thai_don_hang" class="form-select w-75"
                                                                onchange="confirmSubmit(this)"
                                                                data-default-value="{{ $item->trang_thai_don_hang }}">
                                                                @foreach ($trangThaiDonHang as $key => $value)
                                                                    <option value="{{ $key }}"
                                                                        {{ $key == $item->trang_thai_don_hang ? 'selected' : '' }}
                                                                        {{ $key == $typeHuyDonHang ? 'disabled' : '' }}>
                                                                        {{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </form>
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{ route('admins.donhangs.show', $item->id) }}"><i
                                                            class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i></a>

                                                    @if ($item->trang_thai_don_hang == $typeHuyDonHang)
                                                        <form action="{{ route('admins.donhangs.destroy', $item->id) }}"
                                                            method="post" class="d-inline"
                                                            onsubmit="return confirm('Bạn có chắc chắn không?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="border-0 bg-white"><i
                                                                    class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $listDonHang->links('pagination::bootstrap-5') }}
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
    <script>
        function confirmSubmit(selectElement) {
            var form = selectElement.form;
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            var defaultValue = selectElement.getAttribute('data-default-value');

            if (confirm('bạn có chắc chắn thay đổi trạng thái đơn hàng thành "' + selectedOption + '" không?')) {
                form.submit();
            } else {
                selectElement.value = defaultValue;
            }
        }
    </script>
@endsection
