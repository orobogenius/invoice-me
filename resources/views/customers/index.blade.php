@extends('layouts.dashboard')

@section('page-name', 'Customers')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-head d-flex">
            <h4 class="card-title">Manage Customers</h4>
            <div class="ml-auto">
                <a href="{{ route('customers.create') }}" class="btn btn-primary action-btn">
                    <i class="fas fa-plus"></i> Create Customer
                </a>
            </div>
        </div>
        <div class="mt-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Whatsapp Number</th>
                        <th scope="col">Facebook Username</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->whatsapp_number }}</td>
                            <td>{{ $customer->fb_username }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No customers at the moment</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection