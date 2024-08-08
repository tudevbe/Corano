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
                    <h4 class="fs-18 fw-semibold m-0">Quản lí danh mục sản phẩm</h4>
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
                                <form action="{{ route('admins.danhmucs.update', $danhMuc->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Tên danh mục</label>
                                            <input type="text" name="ten_danh_muc" id="simpleinput"
                                                class="form-control @error('ten_danh_muc') is-invalid @enderror"
                                                value="{{ $danhMuc->ten_danh_muc }}" placeholder="Nhập tên danh mục">
                                            @error('ten_danh_muc')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                            <input type="file" id="hinh_anh" name="hinh_anh" class="form-control" onchange="showImage(event)">
                                            <img id="hinh_anh_dm" src="{{Storage::url( $danhMuc->hinh_anh )}}" alt="Ảnh sản phẩm" style="width: 150px;" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="trang_thai" class="form-label">Trạng thái</label>
                                            <div class="col-sm-10 d-flex mb-3 gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="trang_thai"
                                                        id="gridRadios1" value="1" {{$danhMuc->trang_thai == true ? 'checked': ''}} >
                                                    <label class="form-check-label text-success" for="gridRadios1">
                                                        Hiển thị
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input " type="radio" name="trang_thai"
                                                        id="gridRadios2" value="0" {{$danhMuc->trang_thai == false ? 'checked': ''}}>
                                                    <label class="form-check-label text-danger" for="gridRadios2">
                                                        Ẩn
                                                    </label>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-warning">Sửa Danh Mục</button>
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
<script>
    function showImage (event) {
        const img_danh_muc = document.getElementById('hinh_anh_dm');
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function () {
            img_danh_muc.src = reader.result;
            img_danh_muc.style.display = 'block';
        }
        if(file) {
            reader.readAsDataURL(file)

        }
    }
</script>
@endsection
