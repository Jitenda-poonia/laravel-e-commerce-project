<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Notifications\OrderStatusUpdated;
use Barryvdh\DomPDF\Facade\Pdf;

class ManageOrderController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('manage_orders'), 403);

        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        abort_unless(Gate::allows('manage_orders'), 403);
        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('admin.order.show', compact('order', 'billingAddress', 'shippingAddress', 'orderItems'));
    }

    public function generateInvoice($id)
    {
        // echo $id;
        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        $pdf = Pdf::loadView('admin.invoices.order-invoice', compact('order', 'billingAddress', 'shippingAddress', 'orderItems'));
        return $pdf->download($order->order_increment_id . ".pdf");


    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        //Note:: agr mailtraip me 100 email ki limt ho gai h to error aayegi
        if ($order->user) {
            $order->user->notify(new OrderStatusUpdated($order));
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}

