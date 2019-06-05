@extends('layouts.app')

@section('content')
<div class="im-container d-flex justify-content-center align-items-center">
    <div class="im-auth-container">
        <div class="im-form-container pt-5">
            <div class="p-2">
                <h5>Login to your account</h5>
            </div>
            <div class="signup-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row form-group-row">
                        <div class="col-md-12">
                            <i class="fas fa-user"></i>
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="form-group row form-group-row">
                        <div class="col-md-12">
                            <i class="fas fa-key"></i>
                            <input id="password" type="password" class="form-control" placeholder="Password" name="password" required autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary action-btn">
                        {{ __('Login') }}
                    </button>
                </form>
                <div class="mt-5 p-2">
                    <p style="font-size: 12px;">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="link-primary">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
