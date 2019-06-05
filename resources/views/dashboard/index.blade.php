@extends('layouts.dashboard')

@section('page-name', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="font-weight-bold">
            <i class="fas fa-file-invoice fa-1x"></i> Welcome to InvoiceMe! 
        </h4>
        <p class="mt-3">
            Send personalized invoices to your customers and get paid faster.
        </p>
        <p>
            <i class="fas fa-exclamation-circle"></i> Click on invoices to get started.
        </p>
    </div>
</div>
@endsection