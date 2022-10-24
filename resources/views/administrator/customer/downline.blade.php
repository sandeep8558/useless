@extends('layouts.administrator')

@section('head')
<title>Store Manager | Customers</title>
@endsection

@section('content')

<div class="container-fluid my-4">
    <a class="btn btn-dark" href="/administrator/customer/{{$id}}">Go Back</a>
</div>

<div class="container-fluid my-4">
    {{$downline->appends(request()->except('page'))->links()}}
</div>

@foreach($downline as $user)
<div class="row m-0 p-3">
    <div class="col shadow p-3">
        <h3 class="m-0">{{$user->name}} ({{$user->id}})</h3>
        <p class="m-0">{{$user->mobile}} | {{$user->email}}</p>
        <p class="m-0">{{$user->ref}} | {{$user->created_at}}</p>
        <p class="m-0">Balance - {{$user->balance}}</p>
    </div>
</div>
@endforeach

<div class="container-fluid my-4">
    {{$downline->appends(request()->except('page'))->links()}}
</div>

@endsection