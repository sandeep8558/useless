@extends('layouts.administrator')

@section('head')
<title>Administrator | Customers</title>
@endsection

@section('content')

<admin-customers :warehouses="{{$warehouses}}"></admin-customers>

@endsection
