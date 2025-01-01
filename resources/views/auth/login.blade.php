@extends('layouts.app')

@section('content')
<div class="admin-login-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-card">
                    <div class="login-card-header">{{ __('Admin Login') }}</div>
                    <div class="login-card-body">
                        <form method="POST" action="{{ route('admin.login') }}"> @csrf <div class="form-group"> <label
                                    for="email">{{ __('Email Address') }}</label> <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus> @error('email')
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                @enderror
                            </div>
                            <div class="form-group"> <label for="password">{{ __('Password') }}</label> <input
                                    id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password"> @error('password') <span
                                    class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                @enderror </div>
                            <div class="form-group"> <button type="submit" class="btn btn-primary"> {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-none d-md-block">
                <div class="login-logo"> <img src="{{ asset('assets') }}/img/logoAdmin.png" alt="Logo" /></div>
            </div>
        </div>
    </div>
</div>

@endsection