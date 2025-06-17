<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('author', 'like', $searchTerm);
            });
        }

        $books = $query->latest()->paginate(12);

        return view('home', compact('books'));
    }


    public function show(Book $book)
    {
        return view('bookDetail', compact('book'));
    }
}
