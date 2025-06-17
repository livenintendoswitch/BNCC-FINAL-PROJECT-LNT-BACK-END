@extends('layouts.app')

@section('title', 'My Transaction History')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4">My Transaction History</h1>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Your Invoices</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Transaction Date</th>
                                    <th class="text-end">Total Amount</th>
                                    <th class="text-center" style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">{{ $invoice->invoice_number }}</span>
                                        </td>
                                        <td>{{ $invoice->created_at->format('d F Y, H:i') }}</td>
                                        <td class="text-end">Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('user.invoices.show', $invoice->invoice_header_id) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i> Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">You have no transaction history yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($invoices->hasPages())
                    <div class="card-footer">
                        {{ $invoices->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
