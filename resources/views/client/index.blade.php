@extends('layouts.client')
@section('content-client')
<div class="clearfix"></div>
<div class="hom-slider">
    <img src="{{ asset('asset/client/images/banner.webp') }}" alt="">
</div>
<div class="clearfix"></div>
<div class="container_fullwidth">
    <div class="container">
        <div class="hot-products">
            <h3 class="title">Sản Phẩm Bán Chạy</h3>
            <div class="control"></div>
            <ul>
                <li>
                    <div class="row">
                        @foreach ($bellingProducts as $bellingProduct)
                            <div class="col-md-3 col-sm-6">
                                <div class="product-card">
                                    <a href="{{ route('user.products_detail', $bellingProduct->id) }}">
                                        <img src="{{ asset("asset/client/images/products/small/$bellingProduct->img") }}"
                                            alt="" class="product-image">
                                    </a>
                                    <div class="product-details">
                                        <a href="{{ route('user.products_detail', $bellingProduct->id) }}">
                                            <h3 class="product-brand">{{ $bellingProduct->brand_name }}</h3>
                                            <p class="product-name">{{ $bellingProduct->name }}</p>
                                        </a>
                                        <p class="product-price">{{ format_number_to_money($bellingProduct->price_sell) }}
                                            VNĐ</p>
                                        <div class="product-rating">
                                            <x-avg-stars :number="$bellingProduct->avg_rating" />
                                            <span class="sold-quantity">Đã bán: {{ $bellingProduct->sum }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="featured-products">
            <h3 class="title">Sản Phẩm Mới Nhất</h3>
            <div class="control"></div>
            <ul>
                <li>
                    <div class="row">
                        @foreach ($newProducts as $newProduct)
                            <div class="col-md-3 col-sm-6">
                                <div class="product-card">
                                    <a href="{{ route('user.products_detail', $newProduct->id) }}">
                                        <img src="{{ asset("asset/client/images/products/small/$newProduct->img") }}" alt=""
                                            class="product-image">
                                    </a>
                                    <div class="product-details">
                                        <a href="{{ route('user.products_detail', $newProduct->id) }}">
                                            <h3 class="product-brand">{{ $newProduct->brand_name }}</h3>
                                            <p class="product-name">{{ $newProduct->name }}</p>
                                        </a>
                                        <p class="product-price">{{ format_number_to_money($newProduct->price_sell) }} VNĐ
                                        </p>
                                        <div class="product-rating">
                                            <x-avg-stars :number="$newProduct->avg_rating" />
                                            <span class="sold-quantity">Đã bán: {{ $newProduct->sum }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection