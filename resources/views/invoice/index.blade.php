@extends('layouts.dashboard')

@section('page-name', 'Invoices')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-head d-flex">
            <h4 class="card-title">Manage Invoices</h4>
            <div class="ml-auto">
                <a href="{{ route('invoices.create') }}" class="btn btn-primary action-btn">
                    <i class="fas fa-plus"></i> Create Invoice
                </a>
            </div>
        </div>
        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Invoice #</th>
                        <th scope="col">Reference #</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->created_at->diffForHumans() }}</td>
                            <td>{{ $invoice->number }}</td>
                            <td>{{ $invoice->reference }}</td>
                            <td>{{ $invoice->amount }}</td>
                            <td>{{ $invoice->customer->name }}</td>
                            <td>{{ ucfirst($invoice->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No invoices at the moment</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection