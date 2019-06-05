@extends('layouts.dashboard')

@section('page-name', 'Customers')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-head d-flex">
            <h4 class="card-title">Create Customers</h4>
            <div class="ml-auto">
                <a href="{{ route('customers.index') }}" class="btn btn-primary action-btn">
                    <i class="fas fa-users-cog"></i> Customers
                </a>
            </div>
        </div>
        <div class="mt-5">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Customer's Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Customer's Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-3">
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Customer's Phone">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="whatsapp_number" class="col-sm-2 col-form-label">Whatsapp Number</label>
                    <div class="col-sm-3">
                        <input type="text" name="whatsapp_number" class="form-control" id="whatsapp_number" placeholder="Customer's Whatsapp Number">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fb_username" class="col-sm-2 col-form-label">Facebook Username</label>
                    <div class="col-sm-3">
                        <input type="text" name="fb_username" class="form-control" id="fb_username" placeholder="Customer's Facebook Username">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" name="save" class="btn btn-primary action-btn">
                        <i class="fas fa-plus"></i> Save Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection