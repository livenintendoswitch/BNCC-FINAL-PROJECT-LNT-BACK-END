@extends('layouts.admin')

@section('title', 'Book Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Book Management</h1>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Create New Book</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>
                            <img src="{{ $book->image ? asset('storage/' . $book->image) : 'https://via.placeholder.com/80' }}" alt="{{ $book->name }}" width="80">
                        </td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->category->name ?? '-' }}</td>
                        <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">no books in catalog</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $books->links() }}
    </div>
</div>
@endsection
