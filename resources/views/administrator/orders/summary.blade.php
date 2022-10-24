@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')

<div class="container-fluid my-4">
    <p class="title-md text-uppercase">Accepted Order Summary ( {{$total}} )</p>
</div>

<div class="container-fluid my-4">
    @foreach($pincodes as $pin)
        <a class="btn btn-sm {{$pincode==$pin? 'btn-danger' : 'btn-dark'}}" href="?pincode={{$pin}}">{{$pin}}</a>
    @endforeach
</div>

<div class="container-fluid my-4">
    <a class="btn btn-dark" target="_blank" href="/storemanager/orders/accepted/print">Print all labels</a>
</div>

<div class="container-fluid">
    @foreach($orders as $order)
        <div class="row mb-4">

            <div class="col-12 mb-3">
                <p class="title">Order No: {{$order->id}}  ( <span class="text-success">&#8377; {{$order->payable}}</span> )</p>
                <p class="para"><i class="fas fa-fw fa-map-marked-alt"></i> <b>{{$order->address->fullname}}</b> ({{$order->user_id}}) {{$order->address->address}} {{$order->address->city}} {{$order->address->pincode}} {{$order->address->state}} {{$order->address->country}}</p>
            </div>

            <div class="col-12">
                <div class="row">
                    
                    @foreach($order->order_data as $item)
                        <div class="col-12">
                            @if($order->replace_at == null)
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <a href="/product/{{$item->product->product_group_id}}" style="display:inline-block; width:150px;">
                                            <div class="image image-l">
                                                <img class="image-cover" src="{{$item->product->media}}" alt="Demo Image">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-auto text-center">
                                        <h4 class="font-weight-bold text-uppercase bg-dark text-light p-2" style="width:120px;">
                                            @if($item->product->weight != null || $item->product->weight != "")
                                            {{$item->product->weight}}
                                            @endif
                                            @if($item->product->size != null || $item->product->size != "")
                                            {{$item->product->size}}
                                            @endif
                                        </h4>
                                        <h4>QTY - {{$item->qty}}</h4>
                                    </div>
                                    <div class="col">
                                        <p class="title">{{$item->name}} 
                                            <span class="small">
                                                ({{$item->brand}}) - 
                                                @if($item->weight != null || $item->weight != "")
                                                {{$item->weight}}
                                                @endif
                                                @if($item->size != null || $item->size != "")
                                                {{$item->size}}
                                                @endif
                                        </span></p>
                                        <p class="para">MRP: &#8377;{{$item->mrp}} | Price: &#8377;{{$item->rate}} | Quantity: {{$item->qty}}</p>
                                        <p class="para">Product ID: P{{$item->product_id}}</p>
                                        @if($item->product->locations->count() > 0)
                                        <p class="para">Location: {{implode("," ,$item->product->locations->pluck("loc")->toArray())}}</p>
                                        @endif
                                    </div>
                                    <div class="col-auto">
                                        <p class="m-0">Aggregate</p>
                                        <h5>QTY - {{$item->aqty}}</h5>
                                    </div>
                                </div>
                            @else
                                @if($item->replace_at != null)
                                    <div class="row align-items-center mb-4">
                                        <div class="col-4 col-md-3 col-lg-2 col-xl-1">
                                            <a href="/product/{{$item->product->product_group_id}}">
                                                <div class="image image-l">
                                                    <img class="image-cover" src="{{$item->product->media}}" alt="Demo Image">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-8 col-md-9 col-lg-10 col-xl-11">
                                            <p class="title">{{$item->name}} <span class="small">({{$item->brand}}) 
                                                @if($item->weight != null || $item->weight != "")
                                                {{$item->weight}}
                                                @endif
                                                @if($item->size != null || $item->size != "")
                                                {{$item->size}}
                                                @endif</span></p>
                                            <p class="para">MRP: &#8377;{{$item->mrp}} | Price: &#8377;{{$item->rate}} | Quantity: {{$item->qty}}</p>
                                            <p class="para">Product ID: P{{$item->product_id}}</p>
                                            @if($item->product->locations->count() > 0)
                                            <p class="para">Location: {{implode("," ,$item->product->locations->pluck("loc")->toArray())}}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                    
                </div>
            </div>

        </div>
    @endforeach
</div>

@endsection
