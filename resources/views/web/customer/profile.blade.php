@extends('layouts.web')

@section('content')
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30" style="float: left;width:100%;">
                    <div class="nav nav-tabs mb-4" style="float: left; width: 30%;">
                        <style>
                            .nav.nav-tabs.mb-4 a {
                                float: left;
                                width: 100%;
                            }

                            .nav-tabs .nav-link.active {
                                background-color: #FFD333;
                            }
                        </style>

                        <div>
                            Hi, {{ Auth::user()->name }} <br>
                            {{ Auth::user()->email }}
                        </div>

                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1"><i
                                class="fas fa-user"></i> PROFILE DETAILS</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2"><i
                                class="fas fa-heart"></i> WISHLIST</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3"><i
                                class="fas fa-shopping-cart"></i> ORDERS</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4"><i
                                class="fas fa-map-marker-alt"></i> ADDRESS</a>
                        <a class="nav-item nav-link text-dark" href="{{ route('customer.logout') }}"><i
                                class="fas fa-sign-out-alt"></i> LogOut</a>
                    </div>

                    <div class="tab-content" style="float: left;width:70%;padding-right:15px;padding-left:15px;">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            @if (session()->has('error'))
                                <p style="background: #FFD333;padding: 15px;color: #000; font-weight: 500;">
                                    {{ session()->get('error') }}
                                </p>
                            @endif
                            @if (session()->has('success'))
                                <p style="background: #FFD333; padding: 15px; color: #000; font-weight: 500;">
                                    {{ session()->get('success') }}
                                </p>
                            @endif

                            <form action="{{ route('customer.update') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label>Name</label>
                                        <input class="form-control" name="name" value="{{ Auth::user()->name }}"
                                            type="text" placeholder="Enter name">
                                        @error('name')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" name="email" value="{{ Auth::user()->email }}"
                                            type="text" placeholder="Enter email">
                                        @error('email')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Current Password</label>
                                        <input class="form-control" name="current_password" value="" type="password"
                                            placeholder="Enter current password">
                                        @error('current_password')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label> Change Password</label>
                                        <input class="form-control" name="password" value="" type="password"
                                            placeholder="Enter password">
                                        @error('password')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 form-group">
                                        <button type="submit" class="form-control btn btn-primary" style="width: 50%;">Save
                                            Change</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        {{-- wishlist start  --}}
                        <div class="tab-pane fade show" id="tab-pane-2">

                            @forelse ($wishlistItems  as $wishlistItem)
                                <div
                                    style="width:100%;float:left;border:1px solid rgba(0, 0, 0, 0.1);margin-top:1rem;margin-bottom:1rem;">
                                    <a href="{{ route('productData', $wishlistItem->wishlistProduct->url_key) }}">
                                        <div style="width: 20%;padding:20px;float:left;">
                                            <img src="{{ $wishlistItem->wishlistProduct->getFirstMediaUrl('thumbnail_image') }}"
                                                alt="" style="width: 100%;">
                                        </div>
                                        <div style="padding:20px;float:left;width:70%;">
                                            <p>
                                                {{ $wishlistItem->wishlistProduct->name }}
                                            </p>
                                            <p>
                                                {{ getProductPriceShow($wishlistItem->wishlistProduct->id) }}
                                            </p>
                                        </div>

                                    </a>
                                    <div style="padding:20px;float:left;width:10%;">
                                        <form action="{{ route('wishlist.destroy', $wishlistItem->product_id) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>

                                    </div>

                                </div>
                            @empty
                                <h4>No items in your Wishlist.</h4>
                            @endforelse

                        </div>
                        {{-- wishlist end  --}}
                        {{-- order start  --}}
                        <div class="tab-pane fade show" id="tab-pane-3" style="overflow: auto;">

                            <table id="myTable" class="table table-bordered display">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>

                                        <th>OrderId</th>
                                        <th>Subtotal</th>
                                        <th>Coupon</th>
                                        <th>Coupon Discount</th>
                                        <th>Shipping Cost</th>
                                        <th>Total</th>
                                        <th>Payment Method</th>
                                        <th>Shipping Method</th>
                                        <th>view Details</th>
                                        <th>Pdf Invoice</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($orders as $key =>  $_order)
                                        <tr>
                                            <td>{{ ++$key . '.' }}</td>

                                            <td>#{{ $_order->order_increment_id }}</td>
                                            <td>{{ $_order->subtotal }}</td>
                                            <td>{{ $_order->coupon ?? 'No' }}</td>
                                            <td>{{ $_order->coupon_discount }}</td>
                                            <td>{{ $_order->shipping_cost }}</td>
                                            <td>{{ $_order->total }}</td>
                                            <td>{{ ucwords(str_replace('_', ' ', $_order->payment_method)) }}</td>
                                            <td>{{ ucwords(str_replace('_', ' ', $_order->shipping_method)) }}</td>
                                            <td>
                                                <button type="button" data-order-id="{{ $_order->id }}"
                                                    class="btn btn-primary detail_show fa fa-eye">View</button>
                                            </td>
                                            <td>
                                                <a href="{{ route('order.invoice', $_order->id) }}" class="fa fa-print">Invoice</a>
                                              </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="20" align="center">No order.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- order end  --}}

                        {{-- address sart  --}}
                        <div class="tab-pane fade show" id="tab-pane-4">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="_2FCIZU"><span class="_1GczDM">HOME</span></div>
                                    <p class="_2adSi5">
                                        <strong><span class="_3CfVDh">{{ $shippingAddress->name ?? '' }}</span></strong>
                                        <span class="_1Z7fmh _3CfVDh">{{ $shippingAddress->phone ?? '' }}</span>
                                        <span class="_2adSi5 WlNme0">
                                            {{ $shippingAddress->address ?? '' }},
                                            {{ $shippingAddress->address_2 ?? '' }},
                                            {{ $shippingAddress->city ?? '' }},
                                            {{ $shippingAddress->state ?? '' }},
                                            {{ $shippingAddress->country ?? '' }} -
                                            <span class="_2dQV-8">{{ $shippingAddress->pincode ?? '' }}</span>
                                        </span>
                                        
                                    </p>
                                </div>

                            </div>
                        </div>
                        {{-- address end --}}


                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // $(".detail_show").click(function(){
            //     alert('test test');

            // });

            $(".detail_show").on('click', function(e) {
                e.preventDefault();
                var orderId = $(this).data('order-id');
                // alert(orderI);
                var url = "{{ route('customer.product.show', ':id') }}".replace(':id', orderId);

                console.log(url);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    success: function(result) {
                        // console.log(result);
                        $("#tab-pane-3").html(result);
                    },
                    error: function(er) {
                        alert(er);
                    }
                });


            });


        });
    </script>
    <script>
        $(document).ready();
    </script>
@endsection
