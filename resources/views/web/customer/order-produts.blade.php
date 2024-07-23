
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 style="font-weight:500;">Order Information</h5>
                        <hr style="margin: 0; border-width:2px;">
                        <p><strong> Order ID :</strong>
                            <?= $order->order_increment_id ?>
                        </p>
                        <p><strong>Order Date:</strong>
                            <?= $order->created_at ?>
                        </p>
                        <p><strong>Order Status:</strong>
                            <?= ucwords(str_replace('_', ' ', $order->status)) ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 style="font-weight:500;">Account Information</h5>
                        <hr style="margin: 0; border-width:2px;">
                        <p><strong>Customer name:</strong>
                            <?= $order->name ?>
                        </p>
                        <p><strong>Email:</strong>
                            <?= $order->email ?>
                        </p>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-12">


                        <h5 style="font-weight:500;">Address Information</h5>
                        <hr style="margin: 0; border-width:2px;">

                        <div class="row">
                            <div class="col-md-6">
                                <h5 style="font-weight:400;">Billing Address</h5>
                                <p><strong>City:</strong>
                                    <?= $billingAddress->city ?? '' ?>
                                </p>
                                <p><strong>State:</strong>
                                    <?= $billingAddress->state ?? '' ?>
                                </p>
                                <p><strong>Country:</strong>
                                    <?= $billingAddress->country ?? '' ?>
                                </p>
                                <p><strong>PIN Code:</strong>
                                    <?= $billingAddress->pincode ?? '' ?>
                                </p>
                                <p><strong>Address:</strong>
                                    <?= $billingAddress->address ?? '' ?>
                                </p>
                                <p><strong>Address 2:</strong>
                                    <?= $billingAddress->address_2 ?? '' ?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5 style="font-weight:400;">Shipping Address</h5>
                                <p><strong>City:</strong>
                                    <?= $shippingAddress->city ?? '' ?>
                                </p>
                                <p><strong>State:</strong>
                                    <?= $shippingAddress->state ?? '' ?>
                                </p>
                                <p><strong>Country:</strong>
                                    <?= $shippingAddress->country ?? '' ?>
                                </p>
                                <p><strong>PIN Code:</strong>
                                    <?= $shippingAddress->pincode ?? '' ?>
                                </p>
                                <p><strong>Address:</strong>
                                    <?= $shippingAddress->address ?? '' ?>
                                </p>
                                <p><strong>Address 2:</strong>
                                    <?= $shippingAddress->address_2 ?? '' ?>
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

                <br><br>
                <div class="row">
                    <div class="col-md-12">


                        <h5 style="font-weight:500;">Payment & Shipping Method</h5>
                        <hr style="margin: 0; border-width:2px;">

                        <div class="row">
                            <div class="col-md-6">
                                <h5 style="font-weight:400;">Payment Information</h5>
                                <p><strong>Payment Method:</strong>
                                    <?= ucwords(str_replace('_', ' ', $order->payment_method)) ?>
                                </p>

                            </div>
                            <div class="col-md-6">
                                <h5 style="font-weight:400;">Shipping Information</h5>
                                <p><strong>Shipping Method:</strong>
                                    <?= ucwords(str_replace('_', ' ', $order->shipping_method)) ?>
                                </p>

                            </div>
                        </div>

                    </div>

                </div>

                <br><br>
                <div class="row">
                    <div class="col-md-12">


                        <h5 style="font-weight:500;">Item Ordered</h5>
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
                            <?php
                            foreach ($orderItems as $_orderItem) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $_orderItem->name ?>
                                    </td>
                                    <td>
                                        <?= $_orderItem->sku ?>
                                    </td>
                                    <td>
                                        <?= $_orderItem->price ?>
                                    </td>
                                    <td>
                                        <?= $_orderItem->qty ?>
                                    </td>
                                    <td>
                                        <?= $_orderItem->row_total ?>
                                    </td>
                                    <td>
                                        <?= $_orderItem->custom_option ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>

                    </div>

                </div>

                <br><br>
                <div class="row">
                    <div class="col-md-12">

                        <h5 style="font-weight:500;">Order Total</h5>
                        <hr style="margin: 0; border-width:2px;">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <h5 style="font-weight:400;">Account Information</h5>
                            <hr style="margin: 0; border-width:2px;">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Coupon:</th>
                                    <th>
                                        <?= $order->coupon ?? 'No' ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Coupon Discount:</th>
                                    <th>
                                        <?= $order->coupon_discount ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Shipping Cost:</th>
                                    <th>
                                        <?= $order->shipping_cost ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>SubTotal:</th>
                                    <th>
                                        <?= $order->subtotal ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <th>
                                        <?= $order->total ?>
                                    </th>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
