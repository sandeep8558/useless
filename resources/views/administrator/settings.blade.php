@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')

<admin-settings :settings="{{$settings}}"></admin-settings>

@endsection
