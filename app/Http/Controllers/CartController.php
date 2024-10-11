<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('menu') 
                         ->where('user_id', Auth::id())
                         ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function add($menuId, Request $request)
    {
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('menu_id', $menuId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $menuId,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function remove($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Item removed from cart!');
        }

        return redirect()->back()->with('error', 'Item not found in your cart!');
    }
}

