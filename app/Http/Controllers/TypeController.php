<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index () {
        $types = Type::with('menus')->get();
        return view('type.index', compact('types'));
    }

    public function detail ($id) {
        $type = Type::findOrFail($id);

        return view('type.detail', compact('type'));
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|max:2048'
        ]);

        $image = $request->file('image')->store('images/types','public');

        Type::create([
            'name' => $request->name,
            'image' => $image
        ]);

        return redirect('/admin/type')->with('success', 'Berhasil Tambah Tipe');
    }
    public function update (Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'image' => 'image|max:2048'
        ]);

        $type = Type::findOrFail($id);


        if ($request->file('image') !== null ) {
            $image = $request->file('image')->store('images/types','public');
        }else{
            $image = $type->image;
        }

        $type->update([
            'name' => $request->name,
            'image' => $image
        ]);

        return redirect('/admin/type/'.$type->id)->with('success', 'Tipe Telah Diubah');
    }

    public function delete($id) {
        $type = Type::findOrFail($id);

        $menus = Menu::where('type_id', $id)->get();
        foreach ($menus as $menu) {
            Cart::where('menu_id', $menu->id)->delete();
            $menu->delete();
        }

        $type->delete();

        return redirect()->route('type');
    }

    public function createMenu($id) {
        $types = Type::all();

        return view('type.create-menu', compact('types'));
    }

    public function storeMenu(Request $request) {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|max:2048'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store('images/menus','public');
        }

        Menu::create([
            'type_id' => $request->type,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $image ?? null
        ]);

        return redirect()->route('type.detail', $request->type);
    }

    public function editMenu($id) {
        $types = Type::all();
        $menu = Menu::findOrFail($id);

        return view('type.edit-menu', compact('types', 'menu'));
    }

    public function updateMenu(Request $request, $id) {

        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'image|max:2048'
        ]);

        $menu = Menu::findOrFail($id);

        if ($request->file('image') !== null ) {
            $image = $request->file('image')->store('images/menus','public');
        }else{
            $image = $menu->image;
        }

        $menu->update([
            'type_id' => $request->type,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $image
        ]);

        return redirect()->route('type.detail', $request->type);
    }

    public function changeStatusMenu($id) {
        $menu = Menu::findOrFail($id);
        $menu->update([
            'status' => !$menu->status
        ]);

        return redirect()->back();
    }

    public function deleteMenu($id) {
        Cart::where('menu_id', $id)->delete();
        Menu::findOrFail($id)->delete();

        return redirect()->back();
    }
}
