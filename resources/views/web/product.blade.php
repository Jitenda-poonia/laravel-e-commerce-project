@extends('layouts.web')
@section('title')
    <title>MultiShop |{{ $product->url_key }} </title>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ '/' }}">Home</a>
                    <span class="breadcrumb-item">Shop</span>
                    <a class="breadcrumb-item text">{{ $product->name }}</a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($product->getMedia('image') as $image)
                            <div class="carousel-item {{ $i ? 'active' : '' }}" {{ $i = 0 }}>
                                <img class="w-100 h-100" src="{{ $image->getUrl() }}" alt="Image" style="height: 250px">
                            </div>
                        @endforeach

                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3> {{ $product->name }}</h3>
                    
                    {{-- according to conditon price &&  special price show --}}
                    {{ getProductPriceShow($product->id) }}

                    <p class="mb-4">{{ $product->short_description }}</p>
                    <form action="{{ route('cart.store', $product->id) }}" method="POST"> 
                        @csrf
                        @foreach ($attributes as $attributeName => $attributeValues)
                            <br><strong class="text-dark mr-3">{{ $attributeName }} : </strong>
                            @foreach ($attributeValues as $attributeValue)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="{{ $attributeValue->name }}"
                                        name="attribute_value[{{ $attributeName }}]">
                                    {{ $attributeValue->name }}
                                </div>
                            @endforeach
                        @endforeach


                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity" style="width: 130px;">
                                <input type="number" name="cart_item" value="1" min="1" max="20"
                                    class="form-control" style="margin-right: 10px;">
                            </div>

                            <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add
                                To
                                Cart</button>
                        </div>


                    </form>

                    {{-- wishlist --}}

                    <form action="{{ route('wishlist.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id ?? '' }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-outline-dark btn-square"><i class="far fa-heart"></i></button>
                    </form>

                    
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>

                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>{!! $product->description !!}</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May
                Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach (getRelatedProducts($product->related_product) as $_relatedProduct)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ $_relatedProduct->getFirstMediaUrl('image') }}"
                                    alt="" style="height: 250px">
                                <div class="product-action">
                                    
                                    {{-- ----- wishlist--------------- --}}
                                    <form action="{{ route('wishlist.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id ?? '' }}">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-outline-dark btn-square"><i
                                                class="far fa-heart"></i></button>
                                    </form>
                                    {{-- ----End- wishlist--------------- --}}

                                  
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href="{{ $_relatedProduct->url_key }}">{{ $_relatedProduct->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    @if ($_relatedProduct->special_price)
                                        <h3 class="font-weight-semi-bold mb-4" style="float:left; margin-right:10px;">
                                            {{ $_relatedProduct->special_price }}</h3>
                                        <h4 class="font-weight-semi-bold mb-4"><del>{{ $_relatedProduct->price }}</del>
                                        </h4>
                                    @else
                                        <h4 class="font-weight-semi-bold mb-4">{{ $_relatedProduct->price }}</h4>
                                    @endif
                                </div>
                               
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
