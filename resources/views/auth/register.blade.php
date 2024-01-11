@extends('layouts.appauth')

@section('content')
<div class="container" style="width:750px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size:25px;font-weight:bold;text-align:center;">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3" style="margin:0 90px 0 0;">
                            <label for="name" class="col-md-4 col-form-label text-md-end"><b>{{ __('Name') }}</b></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="width:300px;">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3" style="margin:0 90px 0 0;">
                            <label for="email" class="col-md-4 col-form-label text-md-end"><b>{{ __('Email Address') }}</b></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="width:300px;">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="margin:0 90px 0 0;">
                            <label for="password" class="col-md-4 col-form-label text-md-end"><b>{{ __('Password') }}</b></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="width:300px;">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="margin:0 90px 0 0;">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end"><b>{{ __('Confirm Password') }}</b></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="width:300px;">
                            </div>
                        </div>
                        <hr>
                    
                        <div class="row">
                            
                                <div class="col-md-4">
                                <a href="{{url('/auth/facebook')}}" class="btn btn-primary">Facebook</a>
                                </div>
                                <div class="col-md-8">
                                <button type="submit" class="btn btn-primary" style="float: right;">
                                    {{ __('Register') }}
                                </button>
                            
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
