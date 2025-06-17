<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::where('role', 'user')->count();
        $bookCount = Book::count();
        $invoiceCount = Invoice::count();

        $totalRevenue = Invoice::sum('total_price');

        $latestInvoices = Invoice::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'userCount',
            'bookCount',
            'invoiceCount',
            'totalRevenue',
            'latestInvoices'
        ));
    }
}
