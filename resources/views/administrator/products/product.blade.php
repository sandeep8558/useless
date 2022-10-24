@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')
<administrator-products-product :product_group_id="{{$product_group_id}}" :tax="{{$tax ?? ''}}"></administrator-products-product>
@endsection
