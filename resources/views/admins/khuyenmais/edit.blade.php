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
                    <h4 class="fs-18 fw-semibold m-0">Quản lí khuyến mãi</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Input Type</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('admins.khuyenmais.update', $maKhuyenMai->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Mã khuyến mãi</label>
                                            <input type="text" name="ma_khuyen_mai" id="simpleinput" class="form-control"
                                                value="{{ $maKhuyenMai->ma_khuyen_mai }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Giá trị</label>
                                        <input type="number" name="gia_tri" id="simpleinput" class="form-control"
                                            value="{{ $maKhuyenMai->gia_tri }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Số lượng</label>
                                        <input type="number" name="so_luong" id="simpleinput" class="form-control"
                                            value="{{ $maKhuyenMai->so_luong }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Giá trị đơn hàng tối thiểu</label>
                                        <input type="number" name="gia_tri_don_hang_toi_thieu" id="simpleinput" class="form-control"
                                            value="{{ $maKhuyenMai->gia_tri_don_hang_toi_thieu }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Ngày bắt đầu</label>
                                        <input type="datetime-local" name="ngay_bat_dau" id="simpleinput" class="form-control"
                                            value="{{ $maKhuyenMai->ngay_bat_dau }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Ngày kết thúc</label>
                                        <input type="datetime-local" name="ngay_ket_thuc" id="simpleinput" class="form-control"
                                            value="{{ $maKhuyenMai->ngay_ket_thuc }}">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="trang_thai" class="form-label">Trạng thái</label>
                                        <div class="col-sm-10 d-flex mb-3 gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="trang_thai"
                                                    id="gridRadios1" value="1" {{$maKhuyenMai->trang_thai == true ? 'checked': ''}}>
                                                <label class="form-check-label text-success" for="gridRadios1">
                                                    Hoạt động
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input " type="radio" name="trang_thai"
                                                    id="gridRadios2" value="0" {{$maKhuyenMai->trang_thai == false ? 'checked': ''}} >
                                                <label class="form-check-label text-danger" for="gridRadios2">
                                                    Không hoạt động
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                                    </div>
                                </form>
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
