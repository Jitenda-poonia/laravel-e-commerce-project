<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkOut()
    {
        $cartId = Session::get('cart_id');
        $quote = Quote::where('cart_id', $cartId)->first();
        return view('web.checkout', compact('quote'));

    }

    public function CheckoutPlaceOrderStore(request $request)
    {
        // Validation  start
        // If 'ship_to_different_address' is checked, validate shipping fields
        if ($request->has('ship_to_different_address')) {
            $request->validate([

                'shipping_name' => 'required|string|max:25',
                'shipping_email' => 'required|email|max:50',
                'shipping_phone' => 'required|string|max:12',
                'shipping_address' => 'required|string|max:150',
                'shipping_country' => 'required|string|max:15',
                'shipping_state' => 'required|string|max:25',
                'shipping_city' => 'required|string|max:20',
                'shipping_pincode' => 'required|string|max:6|min:6',
            ], [
                'shipping_name.required' => 'name field is required.',
                'shipping_email.required' => 'email field is required.',
                'shipping_phone.required' => ' phone field is required.',
                'shipping_address.required' => 'address field is required.',
            ]);
        } else {
            $request->validate([

                'billing_name' => 'required|string|max:25',
                'billing_email' => 'required|email|max:50',
                'billing_phone' => 'required|string|max:12',
                'billing_address' => 'required|string|max:150',
                'billing_country' => 'required|string|max:15',
                'billing_state' => 'required|string|max:25',
                'billing_city' => 'required|string|max:20',
                'billing_pincode' => 'required|string|max:6|min:6',
            ], [
                'billing_name.required' => 'name field is required.',
                'billing_email.required' => 'email field is required.',
                'billing_phone.required' => ' phone field is required.',
                'billing_address.required' => 'address field is required.',
            ]);

        }
        $request->validate([
            'shipping_method' => 'required',
            'payment' => 'required',
        ]);

        // -----------------End validation -----------------------------------

        $data = $request->all();

        $cartId = Session::get('cart_id');
        $quote = Quote::where('cart_id', $cartId)->first();

        //use for shipping method
        $shippingCost = 0;
        if ($request->shipping_method == "standard_delivery") {
            $shippingCost = 0;
        } elseif ($request->shipping_method == "express_delivery") {
            $shippingCost = 50;
        } elseif ($request->shipping_method == "next_business_day") {
            $shippingCost = 100;
        }
        ;

        //order increment ID create
        $lastOrder = Order::orderBy('order_increment_id', 'desc')->first();

        if ($lastOrder) {
            // Extract the numeric portion from the right side
            $lastId = (int) Str::substr($lastOrder->order_increment_id, -7);

            // Increment and pad with zeros on the left
            $orderIncrementId = Str::padLeft($lastId + 1, 7, '0');
        } else {
            // Set a default increment ID if there is no last order
            $orderIncrementId = '1000000';
        }



        $order = Order::create([
            'order_increment_id' => $orderIncrementId,
            'user_id' => getAuthUserId(),
            'name' => $data['billing_name'],
            'email' => $data['billing_email'],
            'phone' => $data['billing_phone'],
            'address' => $data['billing_address'],
            'address_2' => $data['billing_address_2'],
            'city' => $data['billing_city'],
            'state' => $data['billing_state'],
            'country' => $data['billing_country'],
            'pincode' => $data['billing_pincode'],
            'subtotal' => $quote->subtotal,
            'coupon' => $quote->coupon,
            'coupon_discount' => $quote->coupon_discount ?? 0.00,
            'shipping_cost' => $shippingCost,
            'total' => $quote->total + $shippingCost,
            'payment_method' => $request->payment,
            'shipping_method' => $request->shipping_method

        ]);

        foreach ($quote->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'name' => $item->name,
                'sku' => $item->sku,
                'price' => $item->price,
                'qty' => $item->qty,
                'row_total' => $item->row_total,
                'custom_option' => $item->custom_option
            ]);
        }


        $billingAddress = [
            'order_id' => $order->id,
            'user_id' => getAuthUserId(),
            'name' => $data['billing_name'],
            'email' => $data['billing_email'],
            'phone' => $data['billing_phone'],
            'address' => $data['billing_address'],
            'address_2' => $data['billing_address_2'],
            'city' => $data['billing_city'],
            'state' => $data['billing_state'],
            'country' => $data['billing_country'],
            'pincode' => $data['billing_pincode'],
            'address_type' => "billing"
        ];

        $shippingAddress = [
            'order_id' => $order->id,
            'user_id' => getAuthUserId(),
            'name' => $data['shipping_name'],
            'email' => $data['shipping_email'],
            'phone' => $data['shipping_phone'],
            'address' => $data['shipping_address'],
            'address_2' => $data['shipping_address_2'],
            'city' => $data['shipping_city'],
            'state' => $data['shipping_state'],
            'country' => $data['shipping_country'],
            'pincode' => $data['shipping_pincode'],
            'address_type' => "shipping"
        ];
        
        OrderAddress::create($billingAddress);

        if ($request->ship_to_different_address == "on") {

            OrderAddress::create($shippingAddress);
        } else {

            $billingAddress['address_type'] = "shipping";
            OrderAddress::create($billingAddress);
        }

        
        Quote::where('cart_id', $cartId)->delete();
        QuoteItem::where('quote_id', $quote->id)->delete();

        return redirect()->route('make.payment')->with(['order_increment' => $orderIncrementId]);

    }

    public function makePayment()
    {
        return view('web.make-payment');
    }

    // checkout order success method
    public function CheckoutOrderSuccess()
    {
        return view('web.order-success');
    }
}
