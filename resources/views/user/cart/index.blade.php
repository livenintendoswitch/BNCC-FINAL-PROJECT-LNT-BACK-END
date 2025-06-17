@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Your Shopping Cart</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            @forelse ($cartItems as $item)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div>
                                    <img src="{{ $item->book->image ? asset('storage/' . $item->book->image) : 'https://via.placeholder.com/100' }}" class="img-fluid rounded-3" alt="{{ $item->book->name }}" style="width: 100px;">
                                </div>
                                <div class="ms-3">
                                    <h5>{{ $item->book->name }}</h5>
                                    <p class="small mb-0 text-muted">{{ $item->book->author }}</p>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <div style="width: 170px;">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <label for="quantity-{{$item->id}}" class="form-label me-2">Qty:</label>
                                        <input type="number" id="quantity-{{$item->id}}" name="quantity" min="1" max="{{ $item->book->stock }}" class="form-control form-control-sm text-center" value="{{ $item->quantity }}">
                                        <button type="submit" class="btn btn-link px-2 text-success" data-bs-toggle="tooltip" title="Update Quantity"><i class="bi bi-check-lg"></i></button>
                                    </form>
                                </div>
                                <div style="width: 120px;" class="text-end">
                                    <h5 class="mb-0">Rp {{ number_format($item->book->price, 0, ',', '.') }}</h5>
                                </div>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger ms-2" data-bs-toggle="tooltip" title="Remove Item"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center">
                    <p class="mb-0">Your cart is empty.</p>
                    <a href="{{ route('home') }}" class="alert-link">Start shopping now!</a>
                </div>
            @endforelse
        </div>

        <div class="col-lg-4">
            @if($cartItems->isNotEmpty())
                <div class="card bg-light shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">Order Summary</h4>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                        <hr>

                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 mt-3 py-2">
                                Proceed to Checkout
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
