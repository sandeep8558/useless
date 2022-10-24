@extends('layouts.administrator')

@section('head')
<title>Administrator</title>
@endsection

@section('content')

<div class="container-fluid my-4">
    <p class="title-md text-uppercase">Aggregate Orders Data ({{$order_data->count()}})</p>
</div>

<div class="container-fluid">
    <div class="row">
        @foreach($order_data as $item)
            <div class="col-12">

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
                        <h4>QTY - {{$item->qqq}}</h4>
                    </div>
                    <div class="col">
                        <p class="title">{{$item->name}} 
                            <span class="small">
                                ({{$item->brand}}) - 
                                @if($item->product->weight != null || $item->product->weight != "")
                                {{$item->product->weight}}
                                @endif
                                @if($item->product->size != null || $item->product->size != "")
                                {{$item->product->size}}
                                @endif
                        </span></p>
                        <p class="para">MRP: &#8377;{{$item->product->mrp}} | Price: &#8377;{{$item->product->rate}} | Quantity: {{$item->qqq}}</p>
                        <p class="para">Product ID: P{{$item->product_id}}</p>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

</div>

@endsection
