@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')

<admin-staff-manager :warehouses="{{$warehouses}}"></admin-staff-manager>

@endsection
