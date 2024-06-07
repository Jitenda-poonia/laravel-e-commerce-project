<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;

class OrderStatusNotificationController extends Controller
{
    public function show($id)
    {
        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('web.customer.notify.orderShow', compact('order', 'billingAddress', 'shippingAddress', 'orderItems'));
    }
}
