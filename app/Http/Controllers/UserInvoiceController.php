<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInvoiceController extends Controller
{
    public function index()
    {
        $invoices = Auth::user()->invoices()->latest()->paginate(15);
        return view('user.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Access Denied');
        }

        $invoice->load('details.book');

        return view('user.invoices.show', compact('invoice'));
    }
}
