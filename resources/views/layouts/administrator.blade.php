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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">

<div id="menu" class="menu bg-light">
    <div class="menu-container">
        <div class="container p-0 bg-dark text-light">
            <h5 class="text-uppercase p-0 m-0 p-3">ADMINISTRATOR</h5>
        </div>

        <ul class="list-group mb-5 rounded-0 accordion p-1" id="accordionExample">

        <!--

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator')) ? 'btn-dark' : 'btn-outline-dark' }}" href="/administrator">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/homepage/*')) ? 'btn-dark' : 'btn-outline-dark' }}" href="#" onclick="return false;" data-toggle="collapse" data-target="#collapseAccounts">
                    <i class="fas fa-fw fa-user-alt"></i>
                    My Permissions
                    <i class="fas fa-angle-down float-right mt-1"></i>
                </a>
                <ul class="list-group list-group-flush collapse {{ (request()->is('administrator/homepage/*')) ? 'show' : '' }}" data-parent="#accordionExample" id="collapseAccounts">
                    @if(Auth::user())
                        @foreach(Auth::user()->roles as $role) 
                            <li class="list-group-item p-0 shadow-none border-0">
                                <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/{{strtolower($role->role)}}">{{$role->role}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/offers_manager')) ? 'btn-dark' : 'btn-outline-dark' }}" href="/administrator/offers_manager">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    Offers Manager
                </a>
            </li>

            

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/staff_manager')) ? 'btn-dark' : 'btn-outline-dark' }}" href="/administrator/staff_manager">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    Staff Manager
                </a>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/supplier_manager*')) ? 'btn-dark' : 'btn-outline-dark' }}" href="/administrator/supplier_manager">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    Supplier Manager
                </a>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/settings')) ? 'btn-dark' : 'btn-outline-dark' }}" href="/administrator/settings">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    Settings
                </a>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/locations/*')) ? 'btn-dark' : 'btn-outline-dark' }}" href="#" onclick="return false;" data-toggle="collapse" data-target="#collapseLocation">
                    <i class="fas fa-fw fa-user-alt"></i>
                    Locations
                    <i class="fas fa-angle-down float-right mt-1"></i>
                </a>
                <ul class="list-group list-group-flush collapse {{ (request()->is('administrator/locations/*')) ? 'show' : '' }}" data-parent="#accordionExample" id="collapseLocation">
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/locations/warehouse">Warehouse</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/locations/serving_area">Serving Area</a>
                    </li>
                </ul>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/products/*')) ? 'btn-dark' : 'btn-outline-dark' }}" href="#" onclick="return false;" data-toggle="collapse" data-target="#collapseProductManager">
                    <i class="fas fa-fw fa-user-alt"></i>
                    Product Manager
                    <i class="fas fa-angle-down float-right mt-1"></i>
                </a>
                <ul class="list-group list-group-flush collapse {{ (request()->is('administrator/products/*')) ? 'show' : '' }}" data-parent="#accordionExample" id="collapseProductManager">
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/products/category">Category</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/products/sub_category">Sub-Category</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/products/product_group">Product Group</a>
                    </li>
                </ul>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/homepage/slider_manager')) ? 'btn-dark' : 'btn-outline-dark' }}" href="/administrator/homepage/slider_manager">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    Slider Manager
                </a>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/homepage/*')) ? 'btn-dark' : 'btn-outline-dark' }}" href="#" onclick="return false;" data-toggle="collapse" data-target="#collapseHomePage">
                    <i class="fas fa-fw fa-user-alt"></i>
                    Home Page
                    <i class="fas fa-angle-down float-right mt-1"></i>
                </a>
                <ul class="list-group list-group-flush collapse {{ (request()->is('administrator/homepage/*')) ? 'show' : '' }}" data-parent="#accordionExample" id="collapseHomePage">
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/homepage/slider_manager">Slider Manager</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/homepage/tags_manager">Tags Manager</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/homepage/business_manager">Business Manager</a>
                    </li>
                </ul>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/orders/*')) ? 'btn-dark' : 'btn-outline-dark' }}" href="#" onclick="return false;" data-toggle="collapse" data-target="#collapseorders">
                    <i class="fas fa-fw fa-user-alt"></i>
                    Orders
                    <i class="fas fa-angle-down float-right mt-1"></i>
                </a>
                <ul class="list-group list-group-flush collapse {{ (request()->is('administrator/orders/*')) ? 'show' : '' }}" data-parent="#accordionExample" id="collapseorders">
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/orders/pending">Pending</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/orders/accepted">Accepted</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/orders/packed">Packed</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/orders/shipped">Shipped</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/orders/delivered">Delivered</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/orders/cancelled">Cancelled</a>
                    </li>
                </ul>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/replacements/*')) ? 'btn-dark' : 'btn-outline-dark' }}" href="#" onclick="return false;" data-toggle="collapse" data-target="#collapsereplacements">
                    <i class="fas fa-fw fa-user-alt"></i>
                    Replacement
                    <i class="fas fa-angle-down float-right mt-1"></i>
                </a>
                <ul class="list-group list-group-flush collapse {{ (request()->is('administrator/replacements/*')) ? 'show' : '' }}" data-parent="#accordionExample" id="collapsereplacements">
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/replacements/pending">Pending</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/replacements/accepted">Accepted</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/replacements/packed">Packed</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/replacements/shipped">Shipped</a>
                    </li>
                    <li class="list-group-item p-0 shadow-none border-0">
                        <a class="btn btn-block text-left shadow-none border rounded-big pl-5 py-2 mt-1" href="/administrator/replacements/delivered">Delivered</a>
                    </li>
                </ul>
            </li>

            <li class="list-group-item p-0 bg-light mb-1 border-0 shadow-none">
                <a class="btn btn-block text-left shadow-none p-3 rounded-big  {{ (request()->is('administrator/customers')) ? 'btn-dark' : 'btn-outline-dark' }}" href="/administrator/customers">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    Customers
                </a>
            </li>

            -->


        </ul>


    </div>
</div>

<div id="panel" class="panel">
<nav class="navbar navbar-expand navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand text-uppercase" id="handel" href="javascript:void(0);"><i class="fas fa-bars fa-lg fa-fw"></i> {{Auth::user()->name}}</a>
        <ul class="navbar-nav">
            <!-- <li class="nav-item">
                <a class="nav-link" href="/">Website</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>

    @yield('content')
</div>



</div>

@include('sweetalert::alert')

</body>
</html>
