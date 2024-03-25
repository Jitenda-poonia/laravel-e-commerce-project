@extends('layouts.web')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">{{ $category->name }}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

   
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>



                <div class="bg-light p-4 mb-30">
                    <style>
                        input[type="checkbox"].custom-control-input {
                            z-index: inherit;
                            opacity: inherit;
                        }
                    </style>
                    <form action="">
                        @foreach ($request->except('price') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        @foreach (getProductPriceFilter($category->id) as $product)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="radio" onchange="form.submit()"
                                    {{ ($request->price ?? 0) == $product['start'] . '-' . $product['end'] ? 'checked' : '' }}
                                    name="price" class=" priceCheckbox"
                                    value="{{ $product['start'] . '-' . $product['end'] }}">
                                <label
                                    class="custom-control-label">{{ '₹' . $product['start'] . ' - ' . '₹' . $product['end'] }}</label>
                                <span class="badge border font-weight-normal">{{ $product['count'] }}</span>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->




                <!-- Price End -->

                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <!-- Sorting product data -->
                                    <form action="">
                                        @foreach ($request->except('sorting') as $key => $value)
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endforeach
                                        <select id="sorting_product" name="sorting" onchange="form.submit()">
                                            <option value="">Sorting</option>
                                            <option value="latest"
                                                {{ ($request->sorting ?? '') == 'latest' ? 'selected' : '' }}>
                                                Latest</option>
                                            <option value="low_to_high"
                                                {{ ($request->sorting ?? '') == 'low_to_high' ? 'selected' : '' }}>Low to
                                                high
                                            </option>
                                            <option value="high_to_low"
                                                {{ ($request->sorting ?? '') == 'high_to_low' ? 'selected' : '' }}>High to
                                                low
                                            </option>
                                        </select>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                        @if (session()->has('success'))
                            <p style="background: #FFD333; padding: 15px; color: #000; font-weight: 500;">
                                {{ session()->get('success') }}</p>
                        @endif
                    </div>


                    @foreach ($products as $_product)
                        {{-- {{ $_product->name }} --}}
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">

                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ $_product->getFirstMediaUrl('image') }}"
                                        alt="" style="height: 250px">
                                    <div class="product-action">
                                     
                                        <form action="{{ route('wishlist.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ Auth::user()->id ?? '' }}" name="user_id">
                                            <input type="hidden" value="{{ $_product->id }}" name="product_id">
                                            <button type="submit" class="btn btn-outline-dark btn-square"><i
                                                    class="far fa-heart"></i></button>
                                        </form>


                                       
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="{{ route('productData', $_product->url_key) }}">{{ $_product->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">

                                        {{ getProductPriceShow($_product->id) }}

                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $products->links() }}

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
