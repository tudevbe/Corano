@extends('layouts.admin')


@section('title')
    {{ $title }}
@endsection


@section('css')
@endsection
@section('content')
    <div class="content">
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lí đơn hàng</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title align-content-center mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Thông tin tài khoản đặt hàng</th>
                                            <th>Thông tin người nhận hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <p>Tên tài khoản: <strong> {{ $donHang->user->name }}</strong></p>
                                                    <p>Email: <strong> {{ $donHang->user->email }}</strong></p>
                                                    <p>Số điện thoại: <strong> {{ $donHang->user->phone }}</strong></p>
                                                    <p>Địa chỉ: <strong> {{ $donHang->user->address }}</strong></p>
                                                    <p>Chức vụ: <strong> {{ $donHang->user->role }}</strong></p>
                                                </ul>
                                            </td>
                                            <td>
                                                <h5>Mã đơn hàng: <span
                                                        class="text-danger">{{ $donHang->ma_don_hang }}</span></h5>
                                                <p>Tên người nhận: <strong>{{ $donHang->ten_nguoi_nhan }}</strong></p>
                                                <p>Email người nhận: <strong>{{ $donHang->email_nguoi_nhan }}</strong></p>
                                                <p>Số điện thoại: <strong>{{ $donHang->sdt_nguoi_nhan }}</strong></p>
                                                <p>Địa chỉ: <strong>{{ $donHang->dia_chi_nguoi_nhan }}</strong></p>
                                                <p>Ngày đặt: <strong>{{ $donHang->created_at->format('d-m-Y') }}</strong>
                                                </p>
                                                <p>Ghi chú:
                                                    <strong>{{ $donHang->ghi_chu != null ? $donHang->ghi_chu : 'không' }}</strong>
                                                </p>
                                                <p>Trạng thái đơn hàng:
                                                    <strong>{{ $trangThaiDonHang[$donHang->trang_thai_don_hang] }}</strong>
                                                </p>
                                                <p>Trạng thái thanh toán:
                                                    <strong>{{ $trangThaiThanhToan[$donHang->trang_thai_thanh_toan] }}</strong>
                                                </p>
                                                <p>Tiền hàng: <strong>{{ number_format($donHang->tien_hang, 0, '', '.') }}
                                                        đ</strong></p>
                                                <p>Phí vận chuyển:
                                                    <strong>{{ number_format($donHang->tien_ship, 0, '', '.') }} đ</strong>
                                                </p>
                                                <p class="text-danger">Tổng tiền:
                                                    <strong>{{ number_format($donHang->tong_tien, 0, '', '.') }}
                                                        đ</strong></p>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title align-content-center mb-0">Sản phẩm của đơn hàng</h5>
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
                                            <th>Hình ảnh</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($donHang->chiTietDonHang as $item)
                                            @php
                                                $sanPham = $item->sanPham;
                                            @endphp
                                            <tr>
                                                <td><img src="{{ Storage::url($sanPham->hinh_anh) }}" alt=""
                                                        width="100px">
                                                </td>
                                                <td>{{ $sanPham->ma_san_pham }}</td>
                                                <td>{{ $sanPham->ten_san_pham }}</td>
                                                <td>{{ number_format($item->don_gia, 0, '', '.') }} đ</td>
                                                <td>{{ $item->so_luong }}</td>
                                                <td>{{ number_format($item->thanh_tien, 0, '', '.') }} đ</td>
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
        </div>
    </div>
@endsection


@section('js')
@endsection
