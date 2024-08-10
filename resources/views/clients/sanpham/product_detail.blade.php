@extends('layouts.client')

@section('title')
    Sản phẩm chỉ tiết
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
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">product details</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{ Storage::url($sanPhamCT->hinh_anh) }}" alt="product-details" />
                                    </div>

                                    @foreach ($sanPhamCT->hinhAnhSanPham as $item)
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{ Storage::url($item->hinh_anh) }}" alt="product-details" />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <div class="pro-nav-thumb">
                                        <img src="{{ Storage::url($sanPhamCT->hinh_anh) }}" alt="product-details" />
                                    </div>
                                    @foreach ($sanPhamCT->hinhAnhSanPham as $item)
                                        <div class="pro-nav-thumb">
                                            <img src="{{ Storage::url($item->hinh_anh) }}" alt="product-details" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        @if ($sanPhamCT->so_luong == 0)
                                            <h2 class="text-danger">Sản phẩm đã hết</h2>
                                        @endif
                                        @if (session('err'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('err') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <a href="#">Mã sản phẩm: {{ $sanPhamCT->ma_san_pham }}</a>
                                    </div>
                                    <h3 class="product-name">{{ $sanPhamCT->ten_san_pham }}</h3>
                                    <div class="ratings d-flex">
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <div class="pro-review">
                                            <span>{{ $sanPhamCT->luot_xem }} Lượt xem</span>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <span
                                            class="price-regular">{{ $sanPhamCT->gia_khuyen_mai == 0 ? number_format($sanPhamCT->gia_san_pham, 0, '', '.') : number_format($sanPhamCT->gia_khuyen_mai, 0, '', '.') }}
                                            đ</span>
                                        <span class="price-old"><del>{{ $sanPhamCT->gia_khuyen_mai == 0 ? '' : number_format($sanPhamCT->gia_san_pham, 0, '', '.') }}
                                                đ</del></span>
                                    </div>
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span>Số lượng: {{ $sanPhamCT->so_luong }}</span>
                                    </div>
                                    <p class="pro-desc">
                                        Mô tả ngắn: <br>
                                        {{ $sanPhamCT->mo_ta_ngan }}
                                    </p>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">Số lượng:</h6>
                                            <div class="quantity">
                                                <div class="pro-qty"><input type="text" value="1" name="quantity"
                                                        id="quantityInput"></div>
                                                <input type="hidden" name="product_id" value=" {{ $sanPhamCT->id }}">
                                            </div>
                                            <div class="action_link">
                                                @if ($sanPhamCT->so_luong > 0)
                                                    <button type="submit" class="btn btn-cart">add to cart</button>
                                                @else
                                                    <button class="btn btn-cart" disabled>add to cart</button>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_three">reviews (0)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                {!! $sanPhamCT->noi_dung !!}
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_three">
                                            <form action="#" class="review-form">
                                                <h5>1 review for <span>Chaz Kangeroo</span></h5>
                                                <div class="total-reviews">
                                                    <div class="rev-avatar">
                                                        <img src="assets/img/about/avatar.jpg" alt="">
                                                    </div>
                                                    <div class="review-box">
                                                        <div class="ratings">
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span class="good"><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                        </div>
                                                        <div class="post-author">
                                                            <p><span>admin -</span> 30 Mar, 2019</p>
                                                        </div>
                                                        <p>Aliquam fringilla euismod risus ac bibendum. Sed sit
                                                            amet sem varius ante feugiat lacinia. Nunc ipsum nulla,
                                                            vulputate ut venenatis vitae, malesuada ut mi. Quisque
                                                            iaculis, dui congue placerat pretium, augue erat
                                                            accumsan lacus</p>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Name</label>
                                                        <input type="text" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Email</label>
                                                        <input type="email" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Your Review</label>
                                                        <textarea class="form-control" required></textarea>
                                                        <div class="help-block pt-10"><span
                                                                class="text-danger">Note:</span>
                                                            HTML is not translated!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Rating</label>
                                                        &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                        <input type="radio" value="1" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="2" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="3" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="4" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="5" name="rating" checked>
                                                        &nbsp;Good
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button class="btn btn-sqr" type="submit">Continue</button>
                                                </div>
                                            </form> <!-- end of review-form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Related Products</h2>
                        <p class="sub-title">Add related products to weekly lineup</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        @foreach ($sanPham as $item)
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="{{ route('products.detail', $item->id) }}">
                                        <img class="pri-img" src="{{ Storage::url($item->hinh_anh) }}" alt="product">
                                        <img class="sec-img" src="{{ Storage::url($item->hinh_anh) }}" alt="product">
                                    </a>
                                    <form action="{{ route('cart.add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <div class="cart-hover">
                                            @if ($item->so_luong > 0)
                                                <button class="btn btn-cart">add to cart</button>
                                            @else
                                                <button class="btn btn-cart" disabled>add to cart</button>
                                            @endif

                                        </div>
                                    </form>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a
                                                href="#">{{ $item->danhMuc->ten_danh_muc }}</a></p>
                                    </div>
                                    <h6 class="product-name">
                                        <a href="product-details.html">{{ $item->ten_san_pham }}/a>
                                    </h6>
                                    <div class="price-box">
                                        <span
                                            class="price-regular">{{ $item->gia_khuyen_mai == 0 ? number_format($item->gia_san_pham, 0, '', '.') : number_format($item->gia_khuyen_mai, 0, '', '.') }}
                                            đ</span>
                                        <span class="price-old"><del>{{ $item->gia_khuyen_mai == 0 ? '' : number_format($item->gia_san_pham, 0, '', '.') }}
                                                đ</del></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- product item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
@endsection


@section('js')
    <script>
        $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
        $('.pro-qty').append('<span class="inc qtybtn">+</span>');
        $('.qtybtn').on('click', function() {
            var $button = $(this);
            var $input = $button.parent().find('input');
            var oldValue = parseFloat($input.val());

            if ($button.hasClass('inc')) {
                var newVal = oldValue + 1;
            } else {
                if (oldValue > 1) {
                    var newVal = oldValue - 1;
                } else {
                    var newVal = 1;
                }
            }
            $input.val(newVal);

        });

        // xử lí nếu người dùng nhập số âm
        $('#quantityInput').on('change', function() {
            var value = parseInt($(this).val(), 10)

            if (isNaN(value) || value < 1) {
                alert('Số lượng phải lớn hơn 0');
                $(this).val(1);
            }
        })
    </script>
@endsection
