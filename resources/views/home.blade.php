@extends('layouts.app')

@section('title', 'Welcome to the Book Store')

@section('content')
<section class="hero-section text-center py-5">
    <div class="container">
        <h1 class="display-4 mb-4">Find Your Next Favorite Book!</h1>
        <p class="lead">Explore thousands of books from various categories.</p>
    </div>
</section>

<div class="container my-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="{{ route('home') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by title or author..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Search
                </button>
            </form>
        </div>
    </div>

    {{-- Session Messages for actions like adding to cart --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Book Listing --}}
    <div class="row g-4">
        @forelse($books as $book)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $book->image ? asset('storage/' . $book->image) : 'https://via.placeholder.com/400x600' }}" class="card-img-top" alt="{{ $book->name }}" style="height: 300px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ Str::limit($book->name, 40) }}</h5>
                        <p class="card-text text-muted small">{{ $book->author }}</p>
                        <h6 class="card-subtitle mb-2 fw-bold">Rp {{ number_format($book->price, 0, ',', '.') }}</h6>
                        <div class="mt-auto">
                           <a href="{{ route('book.detail', $book->book_id) }}" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-secondary text-center">
                    No books found matching your search criteria.
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $books->appends(request()->query())->links() }}
    </div>
</div>
@endsection
