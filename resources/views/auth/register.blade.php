@extends('layouts.app')

@section('content')
<div class="im-container d-flex justify-content-center align-items-center">
    <div class="im-auth-container">
        <div class="im-form-container pt-5" style="width: 500px;">
            <div class="p-2">
                <h4>Signup for an account</h4>
            </div>
            <div class="signup-form">
                @if ($errors->any())
                    <div class="p-3">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row form-group-row">
                        <div class="col-md-12">
                            <i class="fas fa-id-card"></i>
                            <input id="name" type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>
                    </div>
    
                    <div class="form-group row form-group-row">
                        <div class="col-md-12">
                            <i class="fas fa-envelope"></i>
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group row form-group-row">
                        <div class="col-md-12">
                            <i class="fas fa-lock-open"></i>
                            <input id="password" type="password" class="form-control" placeholder="Password" name="password" required autocomplete="password">
                        </div>
                    </div>
    
                    <div class="form-group row form-group-row">
                        <div class="col-md-12">
                            <i class="fas fa-lock-open"></i>
                            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group row form-group-row">
                        <div class="col-md-12">
                            <i class="fas fa-money-check-alt"></i>
                            <input id="account_name" type="text" class="form-control" name="account_name" placeholder="Account Name" value="{{ old('account_name') }}" required>
                        </div>
                    </div>

                    <div class="form-group row form-group-row">
                        <div class="col-md-12">
                            <i class="fas fa-sort-numeric-up"></i>
                            <input id="account_number" type="text" class="form-control" name="account_number" placeholder="Account Number" value="{{ old('account_number') }}" required>
                        </div>
                    </div>

                    <div class="form-group row form-group-row">
                        <div class="col-md-12">
                            <i class="fas fa-university"></i>
                            <input id="bank_name" type="text" class="form-control" name="bank_name" placeholder="Bank" value="{{ old('bank_name') }}" required>
                        </div>
                    </div>
    
                    <button type="submit" class="btn btn-primary action-btn">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
