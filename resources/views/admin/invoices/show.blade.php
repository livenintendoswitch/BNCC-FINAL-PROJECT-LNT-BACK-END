@extends('layouts.admin')

@section('title', 'Invoice Details ' . $invoice->invoice_number)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Invoice Details</h1>
        <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Invoice List
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Invoice Number: {{ $invoice->invoice_number }}</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Customer Details:</h5>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th style="width: 120px;">Username</th>
                            <td>: {{ $invoice->user->username ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Last Balance</th>
                            <td>: Rp {{ number_format($invoice->user->money ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Transaction Details:</h5>
                     <table class="table table-borderless table-sm">
                        <tr>
                            <th style="width: 120px;">Date</th>
                            <td>: {{ $invoice->created_at->format('d F Y, H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td class="fw-bold">: Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <h5 class="mt-4">Purchased Items Details:</h5>
            <table class="table table-bordered mt-3">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Book Title</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->details as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $detail->book->name ?? 'Book Deleted' }}
                            </td>
                            <td>Rp {{ number_format($detail->book->price ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="fw-bold">
                        <td colspan="4" class="text-end">Grand Total</td>
                        <td class="text-end">Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
