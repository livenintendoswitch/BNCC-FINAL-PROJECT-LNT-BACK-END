<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('book')->get();

        $totalPrice = $cartItems->sum(function($item) {
            return $item->book->price * $item->quantity;
        });

        return view('user.cart.index', compact('cartItems', 'totalPrice'));
    }


    public function add(Request $request, Book $book)
    {
        $user = Auth::user();
        $quantity = $request->input('quantity', 1);

        if ($book->stock < $quantity) {
            return back()->with('error', 'too much quantity, book doesnt have that many stocks');
        }

        $cartItem = Cart::firstOrNew([
            'user_id' => $user->user_id,
            'book_id' => $book->book_id,
        ]);

        $cartItem->quantity += $quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Book.');
    }


    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Access Denied');
        }

        $quantity = $request->input('quantity');

        if ($quantity < 1) {
            return $this->remove($cart);
        }

        if ($cart->book->stock < $quantity) {
             return back()->with('error', 'too much quantity, book doesnt have that many stocks');
        }


        $cart->update(['quantity' => $quantity]);

        return back()->with('success', 'Quantity updated');
    }


    public function remove(Cart $cart)
    {

        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Access Denied');
        }

        $cart->delete();

        return back()->with('success', 'Item succesfully put into cart');
    }
}
