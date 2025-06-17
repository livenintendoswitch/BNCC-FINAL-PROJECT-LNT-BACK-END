@extends('layouts.app')

@section('title', $book->name)

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $book->image ? asset('storage/' . $book->image) : 'https://via.placeholder.com/400x600' }}" class="img-fluid rounded shadow-sm" alt="{{ $book->name }}">
        </div>
        <div class="col-md-8">
            <h2>{{ $book->name }}</h2>
            <p class="text-muted">by {{ $book->author }}</p>
            <h3 class="fw-bold my-3">Rp {{ number_format($book->price, 0, ',', '.') }}</h3>

            <div class="card bg-light p-4 mb-4">

                @auth
                    <form action="{{ route('cart.add', $book->book_id) }}" method="POST">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $book->stock }}" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary w-100" @if($book->stock < 1) disabled @endif>
                                    <i class="bi bi-cart-plus"></i>
                                    @if($book->stock < 1) Out of Stock @else Add to Cart @endif
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="alert alert-warning text-center">
                        Please <a href="{{ route('login.form') }}" class="alert-link">Login</a>
                        or <a href="{{ route('register.form') }}" class="alert-link">Register</a> to purchase this book.
                    </div>
                @endauth
            </div>

            <h5 class="mt-4">Book Description</h5>
            <p>{{ $book->description }}</p>

            <hr>

            <h5>Details:</h5>
            <ul>
                <li>Publisher: {{ $book->publisher }}</li>
                <li>Pages: {{ $book->number_of_page }}</li>
                <li>Stock: {{ $book->stock }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
