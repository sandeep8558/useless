@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')

<admin-supplier-product :supplier_id="{{$id}}"></admin-supplier-product>

@endsection
