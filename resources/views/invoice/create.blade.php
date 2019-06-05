@extends('layouts.dashboard')

@section('page-name', 'Invoices')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-head d-flex">
            <h4 class="card-title">Create Invoices</h4>
            <div class="ml-auto">
                <a href="{{ route('invoices.index') }}" class="btn btn-primary action-btn">
                    <i class="fas fa-file-invoice"></i> Invoices
                </a>
            </div>
        </div>
        <div class="mt-5">
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="invoice_number" class="col-sm-2 col-form-label">Invoice Number</label>
                    <div class="col-sm-5">
                        <input type="text" name="invoice_number" class="form-control" id="invoice_number" value="{{ Str::random(10) }}" placeholder="Invoice Number" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reference" class="col-sm-2 col-form-label">Reference</label>
                    <div class="col-sm-5">
                        <input type="text" name="reference" class="form-control" id="reference" value="{{ Str::random(10) }}" placeholder="Reference Number">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="due_date" class="col-sm-2 col-form-label">Due Date</label>
                    <div class="col-sm-5">
                        <input type="date" name="due_date" value="{{ old('due_date') }}" class="form-control" id="due_date">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer_id" class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-5">
                        <select class="form-control" id="customer_id" name="customer_id">
                            <option selected>Select Customer...</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer_id" class="col-sm-2 col-form-label">Channels</label>
                    <div class="col-sm-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="channels[]" type="checkbox" value="phone" id="phone">
                                    <label class="form-check-label" for="phone">Phone Number</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="whatsapp" name="channels[]" value="whatsapp">
                                <label class="form-check-label" for="whatsapp">Whatsapp</label>
                            </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h5>Add Line Items</h5>
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
                            <tr>
                                <td>
                                    <input type="text" name="line_items[0][description]" class="form-control" placeholder="Item description">
                                </td>
                                <td>
                                    <input type="text" name="line_items[0][quantity]" value="1" class="form-control line-quantity" placeholder="Quantity">
                                </td>
                                <td>
                                    <input type="text" name="line_items[0][unit_price]" class="form-control line-unit" placeholder="Unit Price">
                                </td>
                                <td>
                                    <input type="text" name="line_items[0][amount]" class="form-control line-total" placeholder="Amount">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <button type="submit" name="send" class="btn btn-primary action-btn">
                        <i class="fas fa-share"></i> Save and Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.line-unit').on('blur', function () {
                $parent = $(this).parent().parent();
                var quantity = $parent.find('.line-quantity').val();
                
                $parent.find('.line-total').val(quantity * $(this).val());
            });
        });
    </script>    
@endpush