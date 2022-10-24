<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <div class="container-fluid">
            <div class="container">
                <div class="row align-items-center py-3">
                    <div class="col-auto">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <h4 class="m-0 p-0 text-uppercase font-weight-bold text-dark">{{ config('app.name', 'Laravel') }}</h4>
                        </a>
                    </div>
                    <div class="col text-right">
                        <!-- <a class="text-secondary ml-2" href="{{ route('login') }}"><i class="fas fa-user fa-lg"></i></a> -->
                        <a class="text-secondary ml-2" href="/month_list">
                            <i class="fas fa-heart fa-lg"></i>
                            <sup><span id="monthlist" class="badge badge-primary">{{Auth::check() ? Auth::user()->month_lists()->count() : 0}}</span></sup>
                        </a>
                        <a class="text-secondary ml-2" href="/cart">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <sup><span id="cart" class="badge badge-primary">{{sizeof(json_decode(session('cart')))}}</span></sup>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!-- <ul class="navbar-nav mr-auto">

                    </ul> -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @foreach($categories as $category)
                        <li class="nav-item">
                            <?php
                                $isActive = false;
                                foreach($category->sub_categories as $sub){
                                    if( (request()->is('sub_category/'.$sub->id)) ){
                                        $isActive = true;
                                    }
                                }

                                foreach($category->product_groups as $pro){
                                    if( (request()->is('product/'.$pro->id)) ){
                                        $isActive = true;
                                    }
                                }
                            ?>
                            <a class="nav-link {{ (request()->is('category/'.$category->id)) ? 'active' : ($isActive ? 'active' : '') }}" href="/category/{{$category->id}}">{{$category->name}}</a>
                        </li>
                        @endforeach
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('customer')) ? 'active' : '' }}" href="{{ route('login') }}"><i class="fas fa-user fa-lg"></i></a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <main class="">

            <div class="container">

                <div class="row py-3">

                    <div class="col-12 col-md-4 col-lg-3 d-none d-md-block">
                        <ul class="list-group mb-5">
                            <a class="list-group-item {{ (request()->is('customer')) ? 'active' : '' }}" href="/customer">Dashboard</a>
                            <a class="list-group-item {{ (request()->is('customer/wallet')) ? 'active' : '' }}" href="/customer/wallet">Wallet ( &#8377; {{Auth::user()->balance}} )</a>
                            <a class="list-group-item {{ (request()->is('customer/payout')) ? 'active' : '' }}" href="/customer/payout">Payout</a>
                            <a class="list-group-item {{ (request()->is('customer/downline')) ? 'active' : '' }}" href="/customer/downline">Downline</a>
                            <a class="list-group-item {{ (request()->is('customer/income')) ? 'active' : '' }}" href="/customer/income">Income</a>
                            <a class="list-group-item {{ (request()->is('customer/profile')) ? 'active' : '' }}" href="/customer/profile">Profile</a>
                            <a class="list-group-item {{ (request()->is('customer/address')) ? 'active' : '' }}" href="/customer/address">Address Manager</a>
                            <a class="list-group-item {{ (request()->is('customer/password_change')) ? 'active' : '' }}" href="/customer/password_change">Password Change</a>
                            <a class="list-group-item {{ (request()->is('share/*')) ? 'active' : '' }}" href="/share/{{Auth::id()}}">Share</a>
                            <a class="list-group-item {{ (request()->is('customer/logout')) ? 'active' : '' }}" href="/customer/logout">Logout</a>
                        </ul>
                    </div>

                    <div class="col-12 col-md-4 col-lg-3 d-block d-md-none">
                        <div class="input-group my-3">
                            <select class="form-control" name="sub_cats" id="sub_cats">

                                <option value="/customer" {{ (request()->is('customer')) ? 'selected' : '' }}>Dashboard</option>

                                <option value="/customer/wallet" {{ (request()->is('wallet')) ? 'selected' : '' }}>Wallet ( &#8377; {{Auth::user()->balance}} )</option>

                                <option value="/customer/payout" {{ (request()->is('customer/payout')) ? 'selected' : '' }}>Payout</option>

                                <option value="/customer/downline" {{ (request()->is('customer/downline')) ? 'selected' : '' }}>Downline</option>

                                <option value="/customer/income" {{ (request()->is('customer/income')) ? 'selected' : '' }}>Income</option>

                                <option value="/customer/profile" {{ (request()->is('customer/profile')) ? 'selected' : '' }}>Profile</option>

                                <option value="/customer/address" {{ (request()->is('customer/address')) ? 'selected' : '' }}>Address Manager</option>

                                <option value="/customer/password_change" {{ (request()->is('customer/password_change')) ? 'selected' : '' }}>Password Change</option>

                                <option value="/share/{{Auth::id()}}" {{ (request()->is('share/'.Auth::id())) ? 'selected' : '' }}>Share</option>

                                <option value="/customer/logout" {{ (request()->is('customer/logout')) ? 'selected' : '' }}>Logout</option>

                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button">Go</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8 col-lg-9">

                        @if(Auth::user()->verify_at == null & Auth::user()->verified_at == null & Auth::user()->vefirication_failed_at == null)
                            <div class="container-fluid alert-danger py-2 px-3 mb-3">
                                <p class="para">Your account is not verified, please update your profile to verify your account. <a href="/customer/profile">click here</a></p>
                            </div>
                        @elseif(Auth::user()->verify_at != null & Auth::user()->verified_at == null & Auth::user()->vefirication_failed_at == null)
                            <div class="container-fluid alert-info py-2 px-3 mb-3">
                                <p class="para">Your account is under review. <a href="/customer/profile">click here</a></p>
                            </div>
                        @elseif(Auth::user()->verify_at != null & Auth::user()->verified_at == null & Auth::user()->vefirication_failed_at != null)
                            <div class="container-fluid alert-danger py-2 px-3 mb-3">
                                <p class="para">{{Auth::user()->verification_message}} <a href="/customer/profile">click here</a></p>
                            </div>
                        @elseif(Auth::user()->verify_at != null & Auth::user()->verified_at != null & Auth::user()->vefirication_failed_at == null)
                            <div class="container-fluid alert-success py-2 px-3 mb-3">
                                <p class="para">Your account is active.</p>
                            </div>
                        @endif

                        @if(Auth::user()->balance < 1000)
                            <div class="container-fluid alert-info py-3 px-3 mb-3 border border-info rounded">
                                <p class="title">Add Rs 1000/- in your wallet.</p>
                                <p class="para mb-3">Keep your wallet balance Rs1000/- and above and get benefit of unlimited free downline.</p>
                                <a class="btn btn-dark btn-sm" href="/customer/wallet">Go to your wallet.</a>
                            </div>
                        @endif

                        @yield('content')

                    </div>
                </div>

            </div>

        </main>

        <div class="container-fluid bg-warning text-light py-3">
            <div class="container">

                <div class="row align-items-center text-center">
                    <div class="col-6 col-md-3 px-0 py-2">
                        <button class="btn shadow-none para-lg"><i class="fas fa-rupee-sign title-md mr-2" style="vertical-align: middle;"></i> Handsome Income</button>
                    </div>
                    <div class="col-6 col-md-3 px-0 py-2">
                        <button class="btn shadow-none para-lg"><i class="fas fa-shipping-fast title-md mr-2" style="vertical-align: middle;"></i> Free Delivery</button>
                    </div>
                    <div class="col-6 col-md-3 px-0 py-2">
                        <button class="btn shadow-none para-lg"><i class="fas fa-credit-card title-md mr-2" style="vertical-align: middle;"></i> Secure Payment</button>
                    </div>
                    <div class="col-6 col-md-3 px-0 py-2">
                        <button class="btn shadow-none para-lg"><i class="fas fa-headset title-md mr-2" style="vertical-align: middle;"></i> 24/7 Support</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid py-5 text-muted" style="background-color: #000000;">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <p class="title text-uppercase mb-2 text-light">Information</p>
                        <a class="btn btn-default shadow-none d-block text-left px-0 py-0 text-uppercase para text-muted" href="/about">About us</a>
                        <a class="btn btn-default shadow-none d-block text-left px-0 py-0 text-uppercase para text-muted" href="/contact">Contact</a>
                        <a class="btn btn-default shadow-none d-block text-left px-0 py-0 text-uppercase para text-muted" href="/tnc">Terms & Condition</a>
                        <a class="btn btn-default shadow-none d-block text-left px-0 py-0 text-uppercase para text-muted" href="/privacy">Privacy Policy</a>
                        <a class="btn btn-default shadow-none d-block text-left px-0 py-0 text-uppercase para text-muted" href="/return">Return & Exchange</a>
                    </div>

                    <div class="col-6">
                        <p class="title text-uppercase mb-2 text-light">Get in touch</p>
                        <p class="para py-1"><i class="fas fa-envelope fa-fw"></i> info@vainkho.com</p>
                        <p class="para py-1"><i class="fas fa-phone-alt fa-fw"></i> +91-9664588677</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-dark text-light py-3">
            <div class="container">
            <span class="para" style="color: #999;" >Copyright &copy; {{ date('Y') }} <a href="/" class="text-light">VAINKHO ECOMMERCE PVT. LTD.</a> All Rights Reserved.</span>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')

</body>
</html>
