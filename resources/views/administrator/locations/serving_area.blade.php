@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')
<administrator-locations-serving-area :warehouses="{{$warehouses}}"></administrator-locations-serving-area>
@endsection
