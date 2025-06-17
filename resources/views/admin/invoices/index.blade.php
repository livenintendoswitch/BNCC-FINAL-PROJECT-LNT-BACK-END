@extends('layouts.admin')

@section('title', 'invoice')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Invoice Management</h1>
        </div>

    <div class="card">
        <div class="card-header">
            <h4>List of Transactions</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Invoice</th>
                        <th>Username</th>
                        <th>Total of Transactions</th>
                        <th>Date</th>
                        <th style="width: 120px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $invoice)
                        <tr>
                            <td>
                                <span class="badge bg-dark">{{ $invoice->invoice_number }}</span>
                            </td>
                            <td>
                                {{ $invoice->user->username ?? 'User Deleted' }}
                            </td>
                            <td>Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                            <td>{{ $invoice->created_at->format('d F Y, H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.invoices.show', $invoice->invoice_header_id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye-fill"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">no transactions as of today</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $invoices->links() }}
        </div>
    </div>
@endsection
