<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('admin.index', compact('users'));
    }

    public function store(Request $request) {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id) {

        $request->validate([
            'username' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $user->password
        ]);

        return redirect()->back();
    }

    public function delete($id) {
        User::findOrFail($id)->delete();

        return redirect()->back();
    }
}
