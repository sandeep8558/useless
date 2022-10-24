@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')

<admin-supplier-bank :supplier_id="{{$id}}"></admin-supplier-bank>

@endsection
