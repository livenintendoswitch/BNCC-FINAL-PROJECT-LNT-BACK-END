<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('book')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your shopping cart is empty.'); // Translated
        }

        $totalPrice = $cartItems->sum(function($item) {
            return $item->book->price * $item->quantity;
        });

        if ($user->money < $totalPrice) {
            return redirect()->route('cart.index')->with('error', 'Your balance is not sufficient for this transaction.'); // Translated
        }

        foreach ($cartItems as $item) {
            if ($item->book->stock < $item->quantity) {
                return redirect()->route('cart.index')->with('error', 'The stock for the book "' . $item->book->name . '" is insufficient.'); // Translated
            }
        }

        $invoice = DB::transaction(function () use ($user, $cartItems, $totalPrice) {
            $user->decrement('money', $totalPrice);

            $newInvoice = Invoice::create([
                'user_id' => $user->user_id,
                'invoice_number' => 'INV-' . strtoupper(Str::random(8)) . '-' . time(),
                'total_price' => $totalPrice,
            ]);

            foreach ($cartItems as $item) {
                $newInvoice->details()->create([
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->book->price * $item->quantity,
                ]);
                $item->book->decrement('stock', $item->quantity);
            }

            $user->cartItems()->delete();

            return $newInvoice;
        });

        return redirect()->route('user.invoices.show', $invoice->invoice_header_id)->with('success', 'Your purchase was successful!'); // Translated
    }

}
