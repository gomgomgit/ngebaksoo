<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{
    public function __construct() {
            $this->middleware('guest:customer')->except('logout', 'signup');
    }

    public function signin() {
        return view('authentication.signin-client');
    }
    public function signinProcess(Request $request) {
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required'
        ]);


        if (Auth::guard('customer')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/');
        } else {
            return redirect()->back()->withErrors('kombinasi username dan password salah');
        }
    }


    public function signup() {
        return view('authentication.signup-client');
    }
    public function signupProcess(Request $request) {
        $this->validate($request, [
            'username'   => 'required',
            'phone_number'   => 'required|numeric',
            'password' => 'required'
        ]);

        $customer = Customer::create([
            'username'   => $request->username,
            'phone_number'   => $request->phone_number,
            'password' => Hash::make($request->password)
        ]);

        Auth::guard('customer')->login($customer);

        return redirect('/');
    }

    public function logout() {
        Auth::guard('customer')->logout();
        return redirect()->route('client.signin');
    }
}
