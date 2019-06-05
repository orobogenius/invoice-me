@extends('layouts.dashboard')

@section('page-name', 'Invoice')

@section('content')
<div class="card">
    <div class="card-head d-flex">
        <div class="ml-auto">
            <a href="#" class="btn btn-primary action-btn">
                <i class="fas fa-print"></i> Print
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <h4><strong>Invoice Number</strong></h4>
                <div>
                    {{ $invoice->number }}
                </div>
            </div>
            <div class="col-sm-4">
                <h4><strong>Customer</strong></h4>
                <div>
                    {{ $invoice->customer->name }}
                </div>
            </div>
            <div class="col-sm-4">
                <h4><strong>Reference</strong></h4>
                <div>
                    {{ $invoice->reference }}
                </div>
            </div>
            
        </div>
        <div class="row mt-5">
            <div class="col-sm-4">
                <h4><strong>Sum Total</strong></h4>
                <div>
                    {{ $invoice->amount }}
                </div>
            </div>
            <div class="col-sm-4">
                <h4><strong>Due Date</strong></h4>
                <div>
                    {{ $invoice->due_date }}
                </div>
            </div>
            <div class="col-sm-4">
                <h4><strong>Status</strong></h4>
                <div>
                    {{ ucfirst($invoice->status) }}
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h5>Line Items</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->items as $item)
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{ $item->description }}" readonly>
                        </td>
                        <td>
                            <input type="text" value="1" class="form-control" value="{{ $item->quantity }}" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control"  value="{{ $item->unit_price }}" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{ $item->amount }}" readonly>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection