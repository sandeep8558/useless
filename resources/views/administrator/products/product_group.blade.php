@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')
<administrator-products-product-group :categories="{{$categories}}" :sub_categories="{{$sub_categories}}"></administrator-products-product-group>
@endsection
