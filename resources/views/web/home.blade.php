@extends('layouts.web')
@section('title')
    <title>MultiShop</title>
@endsection
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($sliders as $slider)
                            <li data-target="#header-carousel" class="{{ $i == 0 ? 'active' : '' }}"
                                data-slide-to="{{ $i }}" {{ $i++ }}></li>
                        @endforeach

                    </ol>
                    <div class="carousel-inner">
                        @foreach ($sliders as $slider)
                            <div class="carousel-item position-relative  {{ $i ? 'active' : '' }}" {{ $i = 0 }}
                                style="height: 430px;">

                                <img class="position-absolute w-100 h-100" src="{{ $slider->getFirstMediaUrl('image') }}"
                                    style="object-fit: cover;">

                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                            {{ $slider->title }}</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet
                                            lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                            href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            @php
                $specialOffer = block('special-offer-1'); //Helper/page.php se;
            @endphp

            {!! $specialOffer->description !!}

        </div>
    </div>
    <!-- Carousel End -->

    <!-- Featured Start -->

    @php
        $featured = block('featured'); //Helper/page.php se
    @endphp

    {!! $featured->description !!}

    <!-- Featured End -->

    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
            @foreach (mostCategories() as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none" href="{{ route('categoryData', $category->url_key) }}">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                <img class="img-fluid" src="{{ $category->getFirstMediaUrl('image') }}" alt="" >
                            </div>
                            <div class="flex-fill pl-3">
                                <h6>{{ $category->name }}</h6>

                                <small class="text-body"> {{ $category->products->count() }} Products </small>
                                   
                               
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Categories End -->

    <!-- Featured Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured
                Products</span></h2>
        <div class="row px-xl-5">
            @foreach (featuredProducts() as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ $product->getFirstMediaUrl('thumbnail_image', 'thumb') }}"
                                alt="" style="height: 250px">
                            <div class="product-action">

                                <form action="{{ route('wishlist.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id ?? '' }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-outline-dark btn-square"><i
                                            class="far fa-heart"></i></button>
                                </form>

                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"
                                href="{{ route('productData', $product->url_key) }}">{{ $product->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">

                                {{-- price show --}}
                                {{ getProductPriceShow($product->id) }}


                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Featured Products End -->

    <!-- Offer Start -->
    @php
        $specialOffer = block('special-offer'); //Helper/page.php se;
    @endphp

    {!! $specialOffer->description !!}
    <!-- Offer End -->

    <!-- RECENT PRODUCTS Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent
                Products</span></h2>
        <div class="row px-xl-5">

            @foreach (recentProducts($product->id) as $recentProduct)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ $recentProduct->getFirstMediaUrl('thumbnail_image') }}"
                                alt="" style="height: 250px">
                            <div class="product-action">
                                
                               
                                <form action="{{ route('wishlist.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id ?? '' }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-outline-dark btn-square"><i
                                            class="far fa-heart"></i></button>
                                </form>

                                
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"
                                href="{{ route('productData', $recentProduct->url_key) }}">{{ $recentProduct->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">

                                {{-- price show --}}
                                {{ getProductPriceShow($recentProduct->id) }}

                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--RECENT PRODUCTS End -->

    <!-- Vendor Start -->
    @php
        $Vendor = block('company'); //Helper/page.php se; where block = function & company = identifier(admin panel se)
    @endphp

    {!! $Vendor->description !!}
    <!-- Vendor End -->
@endsection
