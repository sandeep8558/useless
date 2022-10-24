@extends('layouts.administrator')

@section('head')
<title>Store Manager | Customer</title>
@endsection

@section('content')

<div class="row py-4 m-0">
    
    @if($user->dp != null)
        <div class="col-auto">
            <image style="width:100px;" src="{{$user->dp}}" />
        </div>
    @endif

    <div class="col">
        <h3 class="text-capitalize">{{$user->name}}</h3>
        <p class="m-0 lead"><b>Billing Address:</b> {{$user->billing_address}} {{$user->billing_city}} {{$user->billing_pincode}} {{$user->billing_state}} {{$user->billing_country}}</p>
        <p class="m-0 lead"><b>Mobile:</b> {{$user->mobile}} | <b>Email Address:</b> {{$user->email}}</p>
    </div>

</div>

<div class="container-fluid p-3">
    <div class="row">

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <a class="bnt btn-link text-dark" href="/administrator/customer/{{$user->id}}/wallet">
                            <span class="para">Balance</span>
                            <p class="title responsive">{{$user['balance']}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <a class="bnt btn-link text-dark" href="/administrator/customer/{{$user->id}}/income">
                            <span class="para">Income</span>
                            <p class="title responsive">{{$income}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <a class="bnt btn-link text-dark" href="/administrator/customer/{{$user->id}}/downline">
                            <span class="para">Downline</span>
                            <p class="title responsive">{{$totalDownline}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <a class="bnt btn-link text-dark" href="/administrator/customer/{{$user->id}}/orders">
                            <span class="para">Orders</span>
                            <p class="title responsive">{{$orders}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <a class="bnt btn-link text-dark" href="/administrator/customer/{{$user->id}}/orders">
                            <span class="para">Purchase Amount</span>
                            <p class="title responsive">{{$purchase_amount}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <admin-roles :user_id="{{$id}}"></admin-roles>

</div>

@endsection
