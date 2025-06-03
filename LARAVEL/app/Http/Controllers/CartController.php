<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);
        
        if (!$menu->is_available) {
            return redirect()->back()->with('error', 'Menu tidak tersedia.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity'] += $request->quantity;
        } else {
            $cart[$menu->id] = [
                'name' => $menu->name,
                'quantity' => $request->quantity,
                'price' => $menu->price,
                'image' => $menu->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request)
    {
        if ($request->menu_id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->menu_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function remove(Request $request)
    {
        if ($request->menu_id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->menu_id])) {
                unset($cart[$request->menu_id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang.');
        }
        return redirect()->back()->with('error', 'Menu tidak ditemukan.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}