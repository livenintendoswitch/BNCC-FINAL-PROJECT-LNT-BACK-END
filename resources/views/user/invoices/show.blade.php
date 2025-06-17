@extends('layouts.app')

@section('title', 'Invoice Details')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Invoice Details</h1>
                <a href="{{ route('user.invoices.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to My History
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between">
                        <span><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</span>
                        <span><strong>Date:</strong> {{ $invoice->created_at->format('d F Y') }}</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h5 class="mb-3">Purchased Items:</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Book Title</th>
                                <th scope="col" class="text-end">Unit Price</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->details as $index => $detail)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $detail->book->name ?? 'Book Deleted' }}</td>
                                    <td class="text-end">Rp {{ number_format($detail->book->price ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $detail->quantity }}</td>
                                    <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-top">
                                <td colspan="4" class="text-end pt-3"><strong>Grand Total</strong></td>
                                <td class="text-end pt-3 fs-5"><strong>Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                 <div class="card-footer text-center bg-light">
                    Thank you for your purchase!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
