<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>order details</title>
    </head>

    <body>
        <section class="content-header">
            <h1> Order Details</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <hr style="margin: 0; border-width:2px;">
                                    <h4><strong> ID :</strong> {{ $order->order_increment_id }}</h4>
                                    <h4><strong>Order Date:</strong> {{ $order->created_at }}</h4>
                                    <h4><strong>Order Status:</strong>
                                        {{ ucwords(str_replace('_', ' ', $order->status)) }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <h3 style="font-weight:600;">Account Information</h3>
                                    <hr style="margin: 0; border-width:2px;">
                                    <h4><strong>Customer name:</strong> {{ $order->name }}</h4>
                                    <h4><strong>Email:</strong> {{ $order->email }}</h4>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-12">


                                    <h3 style="font-weight:600;">Address Information</h3>
                                    <hr style="margin: 0; border-width:2px;">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 style="font-weight:600;">Billing Address</h4>
                                            <p><strong>City:</strong> {{ $billingAddress->city ?? '' }}</p>
                                            <p><strong>State:</strong> {{ $billingAddress->state ?? '' }}</p>
                                            <p><strong>Country:</strong> {{ $billingAddress->country ?? '' }}</p>
                                            <p><strong>PIN Code:</strong> {{ $billingAddress->pincode ?? '' }}</p>
                                            <p><strong>Address:</strong> {{ $billingAddress->address ?? '' }}</p>
                                            <p><strong>Address 2:</strong> {{ $billingAddress->address_2 ?? '' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 style="font-weight:600;">Shipping Address</h4>
                                            <p><strong>City:</strong> {{ $shippingAddress->city ?? '' }}</p>
                                            <p><strong>State:</strong> {{ $shippingAddress->state ?? '' }}</p>
                                            <p><strong>Country:</strong> {{ $shippingAddress->country ?? '' }}</p>
                                            <p><strong>PIN Code:</strong> {{ $shippingAddress->pincode ?? '' }}</p>
                                            <p><strong>Address:</strong> {{ $shippingAddress->address ?? '' }}</p>
                                            <p><strong>Address 2:</strong> {{ $shippingAddress->address_2 ?? '' }}</p>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <br><br>
                            <div class="row">
                                <div class="col-md-12">


                                    <h3 style="font-weight:600;">Payment & Shipping Method</h3>
                                    <hr style="margin: 0; border-width:2px;">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 style="font-weight:600;">Payment Information</h4>
                                            <p><strong>Payment Method:</strong>
                                                {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>

                                        </div>
                                        <div class="col-md-6">
                                            <h4 style="font-weight:600;">Shipping Information</h4>
                                            <p><strong>Shipping Method:</strong>
                                                {{ ucwords(str_replace('_', ' ', $order->shipping_method)) }}</p>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            <br><br>
                            <div class="row">
                                <div class="col-md-12">


                                    <h3 style="font-weight:600;">Item Ordered</h3>
                                    <hr style="margin: 0; border-width:2px;">

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th>SKU</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Row Total</th>
                                            <th>Custom Option</th>
                                        </tr>
                                        @foreach ($orderItems as $_orderItem)
                                            <tr>
                                                <td>{{ $_orderItem->name }}</td>
                                                <td>{{ $_orderItem->sku }}</td>
                                                <td>₹{{ $_orderItem->price }}</td>
                                                <td>{{ $_orderItem->qty }}</td>
                                                <td>₹{{ $_orderItem->row_total }}</td>
                                                <td>{{ $_orderItem->custom_option }}</td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>

                            </div>

                            <br><br>
                            <div class="row">
                                <div class="col-md-12">

                                    <h3 style="font-weight:600;">Order Total</h3>
                                    <hr style="margin: 0; border-width:2px;">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <h3 style="font-weight:600;">Amount Information</h3>
                                        <hr style="margin: 0; border-width:2px;">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Coupon:</th>
                                                <th>{{ $order->coupon ?? 'No' }}</th>
                                            </tr>
                                            <tr>
                                                <th>Coupon Discount:</th>
                                                <th>₹{{ $order->coupon_discount }}</th>
                                            </tr>
                                            <tr>
                                                <th>Shipping Cost:</th>
                                                <th>₹{{ $order->shipping_cost }}</th>
                                            </tr>
                                            <tr>
                                                <th>SubTotal:</th>
                                                <th>₹{{ $order->subtotal }}</th>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <th>₹{{ $order->total }}</th>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div>
        </section>
    </body>

</html>
