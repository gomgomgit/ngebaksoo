<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class ClientController extends Controller
{
    public function type() {
        $types = Type::all();

        return view('client.type', compact('types'));
    }
    public function menu($id) {
        $menus = Menu::where('type_id', $id)->get();

        return view('client.menu', compact('menus'));
    }
    public function addCart(Request $request) {
        $customer = Auth::guard('customer')->user()->id;

        Cart::create([
            'customer_id' => $customer,
            'menu_id' => $request->menu_id,
            'quantity' => $request->qty,
            'notes' => $request->notes
        ]);

        flash()->addSuccess('Berhasil ditambahkan ke keranjang');
        return redirect()->back();
    }
    public function editCart(Request $request) {
        Cart::findOrFail($request->cart_id)->update([
            'quantity' => $request->qty,
            'notes' => $request->notes
        ]);

        flash()->addSuccess('Item telah diedit');
        return redirect()->back();
    }
    public function deleteCart(Request $request) {
        $customer = Auth::guard('customer')->user()->id;

        $cart = Cart::findOrFail($request->id);
        if ($cart->customer_id == $customer) {
            $cart->delete();
        }

        flash()->addSuccess('Item telah dihapus');
        return redirect()->back();
    }

    public function history() {
        $user = Auth::guard('customer')->user()->id;
        $orders = Order::with('orderDetails.menu')->where('customer_id', $user)->orderBy('date', 'desc')->paginate(10);

        return view('client.history', compact('orders'));
    }

    public function cart() {
        $user = Auth::guard('customer')->user()->id;
        $carts = Cart::where('customer_id', $user)->get();

        return view('client.cart', compact('carts'));
    }
    public function checkout(Request $request) {
        $request->validate([
            'address' => 'required'
        ]);

        $user = Auth::guard('customer')->user()->id;
        $carts = Cart::with('menu')->where('customer_id', $user)->get();

        $date = Carbon::now();
        $code = Order::whereDate('date', $date)->count();

        $order = Order::create([
            'customer_id' => $user,
            'address' => $request->address,
            'total' => 0,
            'status' => 'pending',
            'date' => $date,
            'order_code' => 'NB-' . $date->format('dmy') .'-'. str_pad($code, 4, '0', STR_PAD_LEFT)
        ]);

        $total = 0;
        foreach ($carts as $cart) {
            OrderDetail::create([
                'order_id' => $order->id,
                'menu_id' => $cart->menu->id,
                'quantity' => $qty = $cart->quantity,
                'price' => $price = $cart->menu->price,
                'subtotal' => $subtotal = $price * $qty
            ]);
            $total += $subtotal;
        }
        $order->update([
            'total' => $total
        ]);

        Cart::where('customer_id', $user)->delete();

        return redirect()->route('client.succeess');
    }

    public function success() {
        return view('client.success');
    }
}
