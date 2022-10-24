@extends('layouts.website')

@section('content')


<div class="container-fluid p-0">
    <div class="image image-s image-hd-md image-header-lg">
        <img class="image-cover" src="/images/register.jpg" alt="Demo Image">
    </div>
</div>

<div class="container">

    <div class="row justify-content-center my-5">

        <div class="col-12 col-sm-12 col-md-6 p-5">
            <h4 class=" text-uppercase d-inline-block border-bottom pb-1 mb-4 border-dark">Register</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">


                    <div class="col-12 form-group">
                        <label class="font-weight-bold" for="name">Full Name</label>
                        <input id="name" type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label class="font-weight-bold" for="billing_pincode">Pincode</label>
                        <input class="form-control rounded-0 @error('billing_pincode') is-invalid @enderror" value="{{ old('billing_pincode') }}" id="billing_pincode" name="billing_pincode" type="text" required autocomplete="billing_pincode" autofocus>
                        @error('billing_pincode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label class="font-weight-bold" for="mobile">Mobile No</label>
                        <input id="mobile" type="text" class="form-control rounded-0 @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label class="font-weight-bold" for="email">Email Address</label>
                        <input class="form-control rounded-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" type="email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label class="font-weight-bold" for="password">Password</label>


                        <div class="input-group">
                            <input class="form-control rounded-0 @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password" >
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
                        <label class="font-weight-bold" for="password-confirm">Confirm Password</label>
                        <input class="form-control rounded-0 @error('password') is-invalid @enderror" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="col-12 form-group">
                        <label class="font-weight-bold" for="first_tier_id">Referance ID (Optional)</label>
                        <?php
                            $first_tier_id = old('email');
                            $readonly = null;
                            if(isset($_GET['first_tier_id'])){
                                $first_tier_id = $_GET['first_tier_id'];
                                $readonly = 'readonly';
                            }
                        ?>
                        <input id="first_tier_id" type="text" class="form-control rounded-0 @error('first_tier_id') is-invalid @enderror" name="first_tier_id" value="{{ $first_tier_id }}" autocomplete="first_tier_id" autofocus {{$readonly}}>
                        @error('first_tier_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="iamagree" id="iamagree" {{ old('iamagree') ? 'checked' : '' }} required>
                                <label class="form-check-label" for="iamagree">
                                    <span class="small">I agree to VAINKHO.com <a target="_blank" href="/tnc">Terms & Conditions</a> and <a target="_blank" href="/privacypolicy">privacy policy</a></span>
                                </label>
                            </div>
                        </div>
                        @error('iamagree')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <input class="btn btn-dark rounded-0 btn-lg text-uppercase" type="submit" value="Register" >
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
