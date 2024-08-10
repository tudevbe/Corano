@extends('layouts.client')

@section('title')
    Đơn hàng của bạn
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
                                <li class="breadcrumb-item active" aria-current="page">Đơn hàng của bạn</li>
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
                        <!-- Cart Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donHangs as $item)
                                        <tr>
                                            <th class="text-center">
                                                {{$item->ma_don_hang}}
                                            </th>
                                            <td>
                                                {{$item->created_at->format('d-m-Y')}}
                                            </td>
                                            <td>
                                                {{$trangThaiDonHang[$item->trang_thai_don_hang]}}
                                            </td>
                                            <td>
                                                {{ number_format($item->tong_tien, 0, '', '.')}} đ
                                            </td>
                                            <td>
                                                <a href="{{route('donhang.show', $item->id)}}" class="btn btn-sqr">View</a>
                                                <form action="{{route('donhang.update', $item->id)}}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    @if ($item->trang_thai_don_hang === $typeChoXacNhan)
                                                        <input type="hidden" name="huy_don_hang" value="1">
                                                        <button type="submit" class="btn btn-sqr bg-danger" onclick="return confirm('Xác nhận hủy đơn hàng')">Hủy</button>
                                                    @elseif ($item->trang_thai_don_hang === $typeDangVanChuyen)
                                                    <input type="hidden" name="da_giao_hang" value="1">
                                                    <button type="submit" class="btn btn-sqr bg-success" onclick="return confirm('Đã nhận hàng')">Đã nhận hàng</button>
                                                    @elseif($item->trang_thai_don_hang === $typeDaXacNhan || $item->trang_thai_don_hang === $typeDangChuanBi)
                                                    <button type="button" class="btn btn-sqr bg-secondary">Đang vận chuyển</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Cart Update Option -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
@endsection

@section('js')
@endsection
