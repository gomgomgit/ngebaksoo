<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(Request $request) {
        $customers = Customer::where('username','like', '%' . $request->search . '%')->orWhere('phone_number','like', '%' . $request->search . '%')->paginate(15);

        return view('customer.index', compact('customers', 'request'));
    }
    public function changePassword(Request $request) {
        $customer = Customer::findOrFail($request->id);
        $customer->update([
            'password' => Hash::make($request->password)
        ]);

        flash()->addSuccess('password berhasi di ubah!');

        return redirect()->route('customer');
    }
}
