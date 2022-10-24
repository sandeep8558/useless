@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')

<div class="container-fluid my-4">
    <p class="title-md text-uppercase">Delivered Order ( {{$total}} )</p>
</div>

<div class="container-fluid my-4">
    <form method="get" action="/administrator/orders/delivered">
        <div class="row items-align-center">
            <div class="col-12">
                <div class="input-group mb-3">
                    <input name="order_id" class="form-control shadow-none autofocus" value="{{ isset($_GET['order_id']) ? $_GET['order_id'] : '' }}" type="text" placeholder="Enter Order ID" autofocus="true">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary shadow-none" type="submit">GO</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid my-4">
    @foreach($pincodes as $pin)
        <a class="btn btn-sm {{$pincode==$pin? 'btn-danger' : 'btn-dark'}}" href="?pincode={{$pin}}">{{$pin}}</a>
    @endforeach
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

                    @if($order->accepted_at != null || $order->accepted_at != "")
                    <?php
                    $accepted = strtotime($order->accepted_at);
                    $acceptedIn = abs(Round(($created - $accepted) / 60));
                    ?>
                    <div class="col-auto para mr-2 mb-2">
                        <div class="small rounded p-2 {{$acceptedIn >= $acceptedMin ? 'alert-danger' : 'alert-success'}}">
                            Accepted at - {{$acceptedIn}}m <br class="p-0 m-0">
                            {{$order->accepted_at}}
                        </div>
                    </div>
                    @endif

                    @if($order->packed_at != null || $order->packed_at != "")
                    <?php
                    $packed = strtotime($order->packed_at);
                    $packedIn = abs(Round(($created - $packed) / 60));
                    ?>
                    <div class="col-auto para mr-2 mb-2">
                        <div class="small rounded p-2 {{$packedIn >= $packedMin ? 'alert-danger' : 'alert-success'}}">
                            Packed at - {{$packedIn}}m <br class="p-0 m-0">
                            {{$order->packed_at}}
                        </div>
                    </div>
                    @endif

                    @if($order->shipped_at != null || $order->shipped_at != "")
                    <?php
                    $shipped = strtotime($order->shipped_at);
                    $shippedIn = abs(Round(($created - $shipped) / 60));
                    ?>
                    <div class="col-auto para mr-2 mb-2">
                        <div class="small rounded p-2 {{$shippedIn >= $shippedMin ? 'alert-danger' : 'alert-success'}}">
                            Shipped at - {{$shippedIn}}m <br class="p-0 m-0">
                            {{$order->shipped_at}}
                        </div>
                    </div>
                    @endif

                    @if($order->delivered_at != null || $order->delivered_at != "")
                    <?php
                    $delivered = strtotime($order->delivered_at);
                    $deliveredIn = abs(Round(($created - $delivered) / 60));
                    ?>
                    <div class="col-auto para mr-2 mb-2">
                        <div class="small rounded p-2 {{$deliveredIn >= $deliveredMin ? 'alert-danger' : 'alert-success'}}">
                            Delivered at - {{$deliveredIn}}m <br class="p-0 m-0">
                            {{$order->delivered_at}}
                        </div>
                    </div>
                    @endif

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
                @if($order->shipment_data->count() > 0)
                    <p class="para"><b>Delivery Partner</b> - 
                        @foreach($order->shipment_data as $sd)
                            {{$sd->shipment->driver_name}} ({{$sd->shipment->driver_mobile}})
                        @endforeach
                    </p>
                @endif
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

            <div class="col-12 mb-3">
                <a class="btn btn-sm btn-dark" target="_blank" href="/administrator/orders/print/{{$order->id}}">Print label</a>
                <a class="btn btn-sm btn-dark" target="_blank" href="/administrator/receipt/{{$order->id}}">Print Receipt</a>
                <a onClick="return confirm('Do you really want to send this order to shipped?')" href="/administrator/orders/{{$order->id}}/to_shipped" class="btn btn-sm btn-outline-info">Back to Shipped</a>
                <a onClick="return confirm('Do you really want to cancel this order?')" href="/administrator/orders/{{$order->id}}/cancel" class="btn btn-sm btn-outline-primary">Cancel Order</a>
                @if($order->replace_at != null)
                <a onClick="return confirm('Do you really want to remove this order from replacement?')" href="/administrator/orders/{{$order->id}}/remove_replacement" class="btn btn-sm btn-outline-warning">Remove from Replacement</a>
                @endif
            </div>

            <div class="col-12">
                @foreach($order->order_data as $item)
                    @if($order->replace_at == null)
                        
                        <div class="row align-items-center mb-4">
                            <div class="col-auto" style="width:150px;">
                                <a href="/product/{{$item->product->product_group_id}}" style="display:inline-block; width:150px;">
                                    <div class="image image-l">
                                    @if($item->cancelled_at != null)
                                        <div style="position:absolute;z-index:1;width:100%; height:80px; opacity:0.5; background-color:red; display:cell;" class="text-light text-center"><h5>Product Cancelled</h5></div>
                                    @endif
                                        <img class="image-cover" src="{{$item->product->media}}" alt="Demo Image">
                                    </div>
                                </a>
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
                                <p class="para">
                                    Product ID: P{{$item->product_id}}
                                    @if($item->cancelled_at == null)
                                    - <a href="/administrator/orders/{{$order->id}}/order_data/{{$item->id}}/return">Return this product</a>
                                    @else                                    
                                    - Cancelled -> {{$item->cancelled_at}}
                                        @if($item->wallet)
                                            @if($item->wallet()->count() > 0)

                                                @if($item->wallet()->where('narration', 'Refund')->count() > $item->wallet()->where('narration', 'Refund Returned')->count())
                                                    - <a href="/administrator/orders/{{$order->id}}/order_data/{{$item->id}}/refund_return">Refund Return</a>
                                                @else
                                                    - <a href="/administrator/orders/{{$order->id}}/order_data/{{$item->id}}/refund">Refund</a>
                                                @endif
                                            
                                            @endif
                                        @else
                                            - <a href="/administrator/orders/{{$order->id}}/order_data/{{$item->id}}/refund">Refund</a>
                                        @endif
                                    @endif
                                </p>

                                @if($item->product->locations->count() > 0)
                                <p class="para">Location: {{implode("," ,$item->product->locations->pluck("loc")->toArray())}}</p>
                                @endif
                                
                            </div>
                        </div>
                        
                    @else
                        @if($item->replace_at != null)
                            <div class="row align-items-center mb-4">
                                <div class="col-auto">
                                    <a href="/product/{{$item->product->product_group_id}}" style="display:inline-block; width:150px;">
                                        <div class="image image-l">
                                            <img class="image-cover" src="{{$item->product->media}}" alt="Demo Image">
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
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
                @endforeach
            </div>

            <!-- <div class="container-fluid my-4 mb-5">
                <a href="/storemanager/orders/{{$order->id}}/to_shipped" class="btn btn-outline-info">Back to Shipped</a>
                <a onClick="return confirm('Do you really want to cancel this order?')" href="/storemanager/orders/{{$order->id}}/cancel" class="btn btn-outline-primary">Cancel Order</a>
                <a onClick="return confirm('Do you really want to proceed?')" href="/storemanager/orders/{{$order->id}}/payment" class="btn btn-outline-primary">{{$order->payment_at == null ? 'Payment Received' : 'Payment Not Received' }}</a>
            </div> -->

            <div class="container-fluid my-4 mb-5">
                <a onClick="return confirm('Do you really want to proceed?')" href="/storemanager/orders/{{$order->id}}/payment" class="btn btn-outline-primary">{{$order->payment_at == null ? 'Payment Received' : 'Payment Not Received' }}</a>
            </div>

        </div>
    @endforeach
</div>

@endsection
