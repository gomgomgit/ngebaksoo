<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->back();
    }
}
