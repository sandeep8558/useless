@extends('layouts.administrator')

@section('head')
<title>Store Manager | Customers</title>
@endsection

@section('content')

<div class="container-fluid my-4">
    <a class="btn btn-dark" href="/administrator/customer/{{$id}}">Go Back</a>
</div>

<div class="container-fluid my-4">
    {{$transactions->appends(request()->except('page'))->links()}}


        @foreach($transactions as $user)
        <div class="row m-0 p-3 align-items-center shadow my-3">
            <div class="col p-3">
                <h3 class="m-0">{{$user->narration}}</h3>
                <p class="m-0">{{$user->side}} | {{$user->created_at}}</p>
            </div>
            <div class="col-auto">
                <h3 class="m-0">&#8377; {{$user->amount}}</h3>
            </div>
        </div>
        @endforeach


    {{$transactions->appends(request()->except('page'))->links()}}
</div>

@endsection