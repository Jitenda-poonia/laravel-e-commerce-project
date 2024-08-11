@extends('layouts.web')

@section('content')
    {{ Breadcrumbs::render('cart') }}
    @if (cartSummaryCount())
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @php $allInStock = true; @endphp
                            @foreach ($quote->items as $item)
                                <tr>
                                    <td class="align-middle"><img src="{{ productImage($item->product_id) }}" alt=""
                                            style="width: 70px;">{{ $item->name }} <br>
                                        {{-- Decode and display custom options --}}
                                        @if ($item->custom_option)
                                            @php
                                                $customOptions = json_decode($item->custom_option, true);
                                            @endphp
                                            @foreach ($customOptions as $attrName => $attrValue)
                                                <strong>{{ $attrName }}:</strong> {{ $attrValue }} <br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="align-middle">₹{{ $item->price }}</td>

                                    {{-- Quantity Update Start --}}
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                @csrf
                                                <input type="number" name="qty" style="width: 65%;"
                                                    value="{{ $item->qty }}" step="1" min="1" max="20"
                                                    class="c-input-text qty text qty-box">
                                                <div class="update-qty" style="display: none">
                                                    <input type="submit" class="btn btn-dark w-200" value="✓">
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="align-middle">₹ {{ $item->row_total }}</td>

                                    <td class="align-middle">
                                        <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                @if ($item->produts->stock_status != 1)
                                    @php $allInStock = false; @endphp
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">

                    @include('web.alert-message')

                    <form class="mb-30" action="{{ route('coupon.apply', $quote->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="coupon" value="{{ $quote->coupon }}"
                                class="form-control border-0 p-4" placeholder="Coupon Code">
                            <div class="input-group-append">
                                @if (!$quote->coupon)
                                    <button type="submit" name="action" value="apply_coupon" class="btn btn-primary">Apply
                                        Coupon</button>
                                @else
                                    <button type="submit" name="action" value="cancel"
                                        class="btn btn-primary">Cancel</button>
                                @endif
                            </div>
                        </div>
                    </form>
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                            Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>₹{{ $quote->subtotal }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Discount</h6>
                                <h6 class="font-weight-medium">-₹{{ $quote->coupon_discount ?? 0.0 }}</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>₹ {{ $quote->total }}</h5>
                            </div>
                            @if ($allInStock)
                                <a href="{{ route('checkout') }}"
                                    class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                            @else
                                <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" disabled>Proceed To
                                    Checkout</button>
                                <div class="text-center mt-2">
                                    <span class="text-danger">One or more items are out of stock. Please remove them to
                                        proceed to checkout.</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12 text-center">
                    <h3 style="background: #FFD333; padding: 20px; display: inline-block;">Add some items to your cart and
                        start shopping!</h3>
                </div>
            </div>
        </div>
    @endif
    <!-- Cart End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.qty-box').on('change', function() {
                var form = $(this).closest('form');
                form.find('.update-qty').css('display', 'block');
            });
        });
    </script>
@endsection
