<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::with(['customer', 'orderDetails.menu'])->where('status', 'pending')->get();

        return view('order.index', compact('orders'));
    }

    public function history() {
        $orders = Order::with(['customer', 'orderDetails.menu'])->where('status', '!=', 'pending')->orderBy('date', 'desc')->paginate(10);

        return view('order.history', compact('orders'));
    }

    public function done($id) {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'done'
        ]);

        return redirect()->back();
    }
    public function cancel($id) {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'done'
        ]);

        return redirect()->back();
    }
}
