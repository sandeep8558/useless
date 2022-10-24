@extends('layouts.administrator')

@section('head')
<title>Store Manager | Customers</title>
@endsection

@section('content')

<div class="container-fluid my-4">
    <p class="title-md text-uppercase">Accepted Order ( {{$total}} )</p>
</div>

<div class="container-fluid my-4">
    <a class="btn btn-dark" href="/administrator/customer/{{$id}}">Go Back</a>
</div>

<div class="container-fluid my-4">
    {{$orders->appends(request()->except('page'))->links()}}
</div>

<div class="container-fluid">
    @foreach($orders as $order)
        <div class="row mb-4">
            <div class="col mb-3">
                <p class="title">Order No: {{$order->id}}  ( <span class="text-success">&#8377; {{$order->payable}}</span> )</p>
                
                <div class="row m-0">

                    <div class="col-auto para mr-2 mb-2">
                        <div class="small alert-dark rounded p-2">
                        Ordered at <br class="p-0 m-0">
                            {{$order->ordered_at}}
                        </div>
                    </div>

                    <?php
                    $created = strtotime($order->ordered_at);
                    ?>

                </div>

                <p class="para {{$order->payment_at == null || $order->payment_at == '' ? 'text-danger' : 'text-success'}}">
                    @if($order->paymentmode == 'Online')
                        Online Payment
                    @elseif($order->paymentmode == 'Wallet')
                        Wallet Payment
                    @elseif($order->paymentmode == 'COD')
                        Cash on delivery
                    @else
                        Not Found
                    @endif
                </p>
                <p class="para {{$order->replace_at == null ? 'text-dark' : 'text-danger'}}">{{$order->status}}</p>
                <p class="para"><i class="fas fa-fw fa-map-marked-alt"></i> <b>{{$order->address->fullname}}</b> ({{$order->user_id}}) {{$order->address->address}} {{$order->address->city}} {{$order->address->pincode}} {{$order->address->state}} {{$order->address->country}}</p>
                <p class="para"><i class="fas fa-fw fa-mobile-alt"></i> {{$order->address->mobile}} <i class="fas fa-fw fa-at"></i> {{$order->address->email}}</p>
            </div>

            @if($order->my_offer != null)
            <div class="col-12 mb-3">
                <p class="alert-info p-3 m-0 rounded-lg">
                    <b>{{$order->my_offer->coupon_code}} - {{$order->my_offer->offer_name}}</b>
                    <br>
                    {{$order->my_offer->offer->description}}
                </p>
            </div>
            @endif
            
            <!-- <div class="col-12 mb-3">
                <a class="btn btn-dark" target="_blank" href="/storemanager/orders/accepted/print">Print all labels</a>
                <a class="btn btn-dark" target="_blank" href="/storemanager/orders/print/{{$order->id}}">Print label</a>
                <a class="btn btn-dark" target="_blank" href="/storemanager/receipt/{{$order->id}}">Print Receipt</a>
                <a class="btn btn-dark" target="_blank" href="/storemanager/order/{{$order->id}}/product_lables">Print Product Labels</a>
            </div> -->

            <div class="col-12">
                @foreach($order->order_data as $item)

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
                            <p class="para">MRP: &#8377;{{$item->mrp}} | Price: &#8377;{{$item->rate}}</p>
                            <p class="para">Product ID: P{{$item->product_id}}</p>
                            @if($item->product->locations->count() > 0)
                            <p class="para">Location: {{implode("," ,$item->product->locations->pluck("loc")->toArray())}}</p>
                            @endif
                        </div>
                    </div>

                @endforeach
            </div>


        </div>
    @endforeach
</div>

@endsection