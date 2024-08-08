@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <!-- Quill css -->
    <link href="{{ asset('assets/admins/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admins/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admins/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
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
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0"> {{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('admins.sanphams.update', $sanPham->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
                                            <input type="text" name="ma_san_pham" id="ma_san_pham"
                                                class="form-control @error('ma_san_pham') is-invalid @enderror"
                                                value="{{ $sanPham->ma_san_pham }}" placeholder="Nhập mã sản phẩm">
                                            @error('ma_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                            <input type="text" name="ten_san_pham" id="ten_san_pham"
                                                class="form-control @error('ten_san_pham') is-invalid @enderror"
                                                value="{{ $sanPham->ten_san_pham }}" placeholder="Nhập tên sản phẩm">
                                            @error('ten_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gia_san_pham" class="form-label">Giá sản phẩm</label>
                                            <input type="number" name="gia_san_pham" id="gia_san_pham"
                                                class="form-control @error('gia_san_pham') is-invalid @enderror"
                                                value="{{ $sanPham->gia_san_pham }}" placeholder="Nhập giá sản phẩm">
                                            @error('gia_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
                                            <input type="number" name="gia_khuyen_mai" id="gia_khuyen_mai"
                                                class="form-control @error('gia_khuyen_mai') is-invalid @enderror"
                                                value="{{ $sanPham->gia_khuyen_mai }}" placeholder="Nhập giá khuyến mãi">
                                            @error('gia_khuyen_mai')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="danh_muc_id" class="form-label">Danh mục</label>
                                            <select name="danh_muc_id" id="danh_muc_id"
                                                class="form-select @error('danh_muc_id') is-invalid @enderror">
                                                <option selected>-- Chọn danh mục --</option>
                                                @foreach ($listDanhMuc as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $sanPham->danh_muc_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->ten_danh_muc }}</option>
                                                @endforeach
                                            </select>
                                            @error('danh_muc_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="so_luong" class="form-label">Số lượng</label>
                                            <input type="number" name="so_luong" id="so_luong"
                                                class="form-control @error('so_luong') is-invalid @enderror"
                                                value="{{ $sanPham->so_luong }}" placeholder="Nhập số lượng">
                                            @error('so_luong')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                                            <input type="date" name="ngay_nhap" id="ngay_nhap"
                                                class="form-control @error('ngay_nhap') is-invalid @enderror"
                                                value="{{ $sanPham->ngay_nhap }}">
                                            @error('ngay_nhap')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="mo_ta_ngan" class="form-label">Mô tả ngắn</label>
                                            <textarea name="mo_ta_ngan" id="mo_ta_ngan" class="form-control @error('mo_ta_ngan') is-invalid @enderror"
                                                placeholder="Mô tả ngắn" rows="3">{{ $sanPham->mo_ta_ngan }}</textarea>
                                            @error('mo_ta_ngan')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="trang_thai" class="form-label">Trạng thái</label>
                                            <div class="col-sm-10 d-flex mb-3 gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="trang_thai"
                                                        id="gridRadios1" value="1"
                                                        {{ $sanPham->trang_thai == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label text-success" for="gridRadios1">
                                                        Hiển thị
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input " type="radio" name="trang_thai"
                                                        id="gridRadios2" value="0"
                                                        {{ $sanPham->trang_thai == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label text-danger" for="gridRadios2">
                                                        Ẩn
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="trang_thai" class="form-label">Tùy chỉnh khác</label>
                                            <div class="form-switch mb-2 ps-3 d-flex justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input bg-danger" type="checkbox"
                                                        id="is_new" name="is_new"
                                                        {{ $sanPham->is_new == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_new">New</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input bg-secondary" type="checkbox"
                                                        id="is_hot" name="is_hot"
                                                        {{ $sanPham->is_hot == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_hot">Hot</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input bg-warning" type="checkbox"
                                                        id="is_hot_deal" name="is_hot_deal"
                                                        {{ $sanPham->is_hot_deal == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_hot_deal">Hot deal</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input bg-success" type="checkbox"
                                                        id="is_show_home" name="is_show_home"
                                                        {{ $sanPham->is_show_home == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_show_home">Show home</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="trang_thai" class="form-label">Mô tả chỉ tiết sản phẩm</label>
                                            <div id="quill-editor" style="height: 400px;">
                                            </div>
                                            <textarea name="noi_dung" id="noi_dung_editor" class="d-none"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                            <input type="file" id="hinh_anh" name="hinh_anh" class="form-control"
                                                onchange="showImage(event)">
                                            <img id="hinh_anh_dm" src="{{ Storage::url($sanPham->hinh_anh) }}"
                                                alt="Ảnh sản phẩm" style="width: 150px;">
                                        </div>

                                        <div class="mb-3">
                                            <label for="hinh_anh" class="form-label">Album hình ảnh</label>
                                            <i id="add-row"
                                                class="mdi mdi-plus text-muted ms-1 fs-18 rounded-2 border p-1"
                                                style="cursor: pointer"></i>
                                            <table class="table align-middle table-nowrap mb-0">
                                                <tbody id="image-table-body">
                                                    @foreach ($sanPham->hinhAnhSanPham as $index => $hinhAnh)
                                                        <tr>
                                                            <td class="d-flex align-items-center">
                                                                <img id="preview_{{$index}}"
                                                                    src="{{ Storage::url($hinhAnh->hinh_anh) }}"
                                                                    alt="Ảnh sản phẩm" style="width: 50px;"
                                                                    class="me-3">
                                                                <input type="file" id="hinh_anh"
                                                                    name="list_hinh_anh[{{$hinhAnh->id}}]" class="form-control"
                                                                    onchange="previewImage(this, {{$index}})">
                                                                    <input type="hidden" name="list_hinh_anh[{{$hinhAnh->id}}]" value="{{$hinhAnh->id}}">
                                                            </td>
                                                            <td>
                                                                <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                                                                    style="cursor: pointer" onclick="removeRow(this)"></i>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Sửa sản phẩm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- start row -->

        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection


@section('js')
    <!-- Quill Editor Js -->
    <script src="{{ asset('assets/admins/libs/quill/quill.core.js') }}"></script>
    <script src="{{ asset('assets/admins/libs/quill/quill.min.js') }}"></script>

    <script>
        function showImage(event) {
            const img_danh_muc = document.getElementById('hinh_anh_dm');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_danh_muc.src = reader.result;
                img_danh_muc.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file)

            }
        }
    </script>

    {{-- script của phần nội dung --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill("#quill-editor", {
                theme: "snow",
            })

            // Hiển thị nội dung cũ
            var old_content = `{!! $sanPham->noi_dung !!}`;
            quill.root.innerHTML = old_content;

            // cập nhật lại textarea ẩn khi nôi dung của quill-editor thay đổi
            quill.on('text-change', function() {
                var noidung = quill.root.innerHTML;
                document.getElementById('noi_dung_editor').value = noidung;
            })
        })
    </script>

    {{-- script của phần Album ảnh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = {{ count($sanPham->hinhAnhSanPham) }};
            document.getElementById('add-row').addEventListener('click', function() {
                var tableBody = document.getElementById('image-table-body');
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td class="d-flex align-items-center">
                        <img id="preview_${rowCount}"
                            src="data:image/png;base64,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"
                            alt="Ảnh sản phẩm" style="width: 50px;" class="me-3">
                        <input type="file" id="hinh_anh"
                            name="list_hinh_anh[id_${rowCount}]" class="form-control"
                            onchange="previewImage(this, ${rowCount})">
                    </td>
                    <td>
                        <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                            style="cursor: pointer" onclick="removeRow(this)"></i>
                    </td>
           `;
                tableBody.appendChild(newRow);
                rowCount++;
            })


        });

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeRow(item) {
            var row = item.closest('tr');
            row.remove();
        }
    </script>
@endsection
