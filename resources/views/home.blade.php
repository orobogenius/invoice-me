@extends('layouts.app')

@section('content')
<div class="im-container">
    <div class="p-5">
        <div class="card w-70">
            <div class="card-body">
                <h3 class="card-title">Invoices</h3>
                <div class="">
                    <a href="{{ route('invoice.create') }}" class="btn btn-primary action-btn">
                        Create
                    </a>
                </div>
                <div class="mt-5">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Invoice Number</th>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->number }}</td>
                                        <td>{{ $invoice->reference }}</td>
                                        <td>{{ $invoice->total }}</td>
                                        <td>{{ $invoice->customer->name }}</td>
                                        <td>{{ $invoice->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
