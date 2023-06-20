<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    public function signin() {
        return view('authentication.signin-admin');
    }
    public function signinProcess(Request $request) {
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required'
        ]);


        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admin');
        } else {
            flash()->addError('kombinasi username dan password salah');
            return redirect()->back()->withInput();
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.signin');
    }
}
