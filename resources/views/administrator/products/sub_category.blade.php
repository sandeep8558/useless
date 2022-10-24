@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')
<administrator-products-sub-category :categories="{{$categories}}"></administrator-products-sub-category>
@endsection
