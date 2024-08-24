@extends('layouts.client')

@section('title')
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
                                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $danhMucDetail->ten_danh_muc }}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- shop main wrapper start -->
                <div class="col-lg-12">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view"
                                                data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view" data-bs-toggle="tooltip"
                                                title="List View"><i class="fa fa-list"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <div class="product-short">
                                            <p>Danh mục : </p>
                                            <select class="nice-select" name="sortby">
                                                @foreach ($danhMuc as $value)
                                                    <option value="{{$value->id}}" {{ $danhMucDetail->id == $value->id ? 'selected' : '' }}>{{$value->ten_danh_muc}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item list wrapper start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            <!-- product single item start -->
                            @foreach ($sanPham as $item)
                                <div class="col-md-4 col-sm-6">
                                    <!-- product grid start -->
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="{{ route('products.detail', $item->id) }}">
                                                <img class="pri-img" src="{{ Storage::url($item->hinh_anh) }}"
                                                    alt="product">
                                                <img class="sec-img" src="{{ Storage::url($item->hinh_anh) }}"
                                                    alt="product">
                                            </a>
                                            <div class="cart-hover">
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
                                            </div>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <div class="product-identity">
                                                <p class="manufacturer-name"><a
                                                        href="{{ route('danh_muc', $item->danh_muc_id) }}">{{ $item->danhMuc->ten_danh_muc }}</a>
                                                </p>
                                            </div>
                                            <h6 class="product-name">
                                                <a href="{{ route('products.detail', $item->id) }}">
                                                    {{$item->ten_san_pham}}</a>
                                            </h6>
                                            <div class="price-box">
                                                <span class="price-regular">{{ $item->gia_khuyen_mai == 0 ? number_format($item->gia_san_pham, 0, '', '.') : number_format($item->gia_khuyen_mai, 0, '', '.') }}
                                                    đ</span>
                                                <span class="price-old"><del>{{ $item->gia_khuyen_mai == 0 ? '' : number_format($item->gia_san_pham, 0, '', '.') }}
                                                    đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->

                                    <!-- product list item end -->
                                    <div class="product-list-item">
                                        <figure class="product-thumb">
                                            <a href="{{ route('products.detail', $item->id) }}">
                                                <img class="pri-img" src="{{ Storage::url($item->hinh_anh) }}"
                                                    alt="product">
                                                <img class="sec-img" src="{{ Storage::url($item->hinh_anh) }}"
                                                    alt="product">
                                            </a>
                                            <div class="cart-hover">
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
                                            </div>
                                        </figure>
                                        <div class="product-content-list">
                                            <div class="manufacturer-name">
                                                <a
                                                    href="{{ route('danh_muc', $item->danh_muc_id) }}">{{ $item->danhMuc->ten_danh_muc }}</a>
                                            </div>
                                            <h5 class="product-name"><a
                                                    href="{{ route('products.detail', $item->id) }}">
                                                    {{$item->ten_san_pham}}</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">{{ $item->gia_khuyen_mai == 0 ? number_format($item->gia_san_pham, 0, '', '.') : number_format($item->gia_khuyen_mai, 0, '', '.') }}
                                                    đ</span>
                                                <span class="price-old"><del>{{ $item->gia_khuyen_mai == 0 ? '' : number_format($item->gia_san_pham, 0, '', '.') }}
                                                    đ</del></span>
                                            </div>
                                            <p>{{$item->mo_ta_ngan}}</p>
                                        </div>
                                    </div>
                                    <!-- product list item end -->

                                </div>
                            @endforeach
                            <!-- product single item start -->


                        </div>
                        <!-- product single item start -->

                    </div>
                    <!-- product item list wrapper end -->
                </div>
            </div>
            <!-- shop main wrapper end -->
        </div>
    </div>
    </div>
@endsection


@section('js')
@endsection
