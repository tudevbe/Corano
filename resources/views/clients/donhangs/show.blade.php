@extends('layouts.client')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('css')
@endsection

@section('content')
<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
 <!-- cart main wrapper start -->
 <div class="cart-main-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-content">
                        <h5>Thông tin đơn hàng: <span class="text-danger">{{$donHang->ma_don_hang}}</span></h5>
                        <div class="welcome">
                            <p>Tên người nhận: <strong>{{$donHang->ten_nguoi_nhan}}</strong></p>
                            <p>Email người nhận: <strong>{{$donHang->email_nguoi_nhan}}</strong></p>
                            <p>Số điện thoại: <strong>{{$donHang->sdt_nguoi_nhan}}</strong></p>
                            <p>Địa chỉ: <strong>{{$donHang->dia_chi_nguoi_nhan}}</strong></p>
                            <p>Ngày đặt: <strong>{{$donHang->created_at->format('d-m-Y')}}</strong></p>
                            <p>Ghi chú: <strong>{{$donHang->ghi_chu != null ? $donHang->ghi_chu : 'không'}}</strong></p>
                            <p>Trạng thái đơn hàng: <strong>{{$trangThaiDonHang[$donHang->trang_thai_don_hang]}}</strong></p>
                            <p>Trạng thái thanh toán: <strong>{{$trangThaiThanhToan[$donHang->trang_thai_thanh_toan]}}</strong></p>
                            <p>Tiền hàng: <strong>{{number_format($donHang->tien_hang, 0, '', '.')}} đ</strong></p>
                            <p>Phí vận chuyển: <strong>{{number_format($donHang->tien_ship, 0, '', '.')}} đ</strong></p>
                            <p>Tổng tiền: <strong>{{number_format($donHang->tong_tien, 0, '', '.')}} đ</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="myaccount-content">
                        <h5>Sản phẩm</h5>
                        <div class="myaccount-table table-responsive text-center">
                            <table class="table table-bordered">
                                <thead class="thead-light">
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
                                        <td><img src="{{Storage::url($sanPham->hinh_anh)}}" alt="" width="100px"></td>
                                        <td>{{$sanPham->ma_san_pham}}</td>
                                        <td>{{$sanPham->ten_san_pham}}</td>
                                        <td>{{number_format($item->don_gia, 0, '', '.')}} đ</td>
                                        <td>{{$item->so_luong}}</td>
                                        <td>{{number_format($item->thanh_tien, 0, '', '.')}} đ</td>
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
<!-- cart main wrapper end -->
@endsection

@section('js')
@endsection
