@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')

<div class="container-fluid p-3">
    <div class="row">

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <span class="para">Total Stores</span>
                        <p class="title responsive">{{$dashboard['warehouses']}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <span class="para">Total Serving Areas</span>
                        <p class="title responsive">{{$dashboard['serving_areas']}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <span class="para">Total Categories</span>
                        <p class="title responsive">{{$dashboard['categories']}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <span class="para">Total Sub-Categories</span>
                        <p class="title responsive">{{$dashboard['sub_categories']}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <span class="para">Total Product Groups</span>
                        <p class="title responsive">{{$dashboard['product_groups']}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <span class="para">Total Products</span>
                        <p class="title responsive">{{$dashboard['products']}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <span class="para">Total Suppliers</span>
                        <p class="title responsive">{{$dashboard['suppliers']}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <span class="para">Total Customers</span>
                        <p class="title responsive">{{$dashboard['customers']}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
            <div class="p-3 rounded-lg alert-white shadow">
                <div class="row align-content-center">
                    <div class="col-auto"><i class="fas fa-user-tie fa-3x"></i></div>
                    <div class="col">
                        <span class="para">Wallet Balance</span>
                        <p class="title responsive">{{$dashboard['wallet_balance']}}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
