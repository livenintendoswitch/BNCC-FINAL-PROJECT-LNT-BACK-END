@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $userCount }}</h5>
                    <p class="card-text">Total User</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $bookCount }}</h5>
                    <p class="card-text">Total Book Titles</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $invoiceCount }}</h5>
                    <p class="card-text">Total Transactions</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h5>
                    <p class="card-text">Total Income</p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5">Newest Transaction</h3>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Invoice Number</th>
                <th>User</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($latestInvoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->user->username }}</td>
                    <td>Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                    <td>{{ $invoice->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">no transaction of as of today.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
