@extends('layouts.website')

@section('content')

<div class="container-fluid p-0">
    <div class="image image-s image-hd-md image-header-lg">
        <img class="image-cover" src="/images/login.jpg" alt="Demo Image">
    </div>
</div>

<div class="container">

    <div class="row justify-content-center my-5">
        <div class="col-12 col-sm-12 col-md-6 col-lg-5 bg-light p-5">

            <h4 class=" text-uppercase d-inline-block border-bottom pb-1 mb-4 border-dark">Login</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">

                    <div class="col-12 form-group">
                        <label class="font-weight-bold" for="login_email">Email Address</label>
                        <input class="form-control rounded-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" id="login_email" name="email" type="email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label class="font-weight-bold" for="login_password">Password</label>
                        <div class="input-group mb-3">
                            <input class="form-control rounded-0 @error('password') is-invalid @enderror" id="login_password" type="password" name="password" required autocomplete="current-password" >
                            <div class="input-group-append" id="show_hide_password" style="cursor:pointer;">
                                <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <input class="btn btn-dark rounded-0 text-uppercase btn-lg" type="submit" value="Login" >
                    </div>

                    <div class="col-12 form-group">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link px-0 mr-4" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>

@endsection
