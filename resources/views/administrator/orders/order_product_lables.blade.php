@extends('layouts.storemanager')

@section('head')
<title>Administrator</title>
@endsection

@section('content')

<div class="container-fluid py-4">
    <form action="/common/order/{{$order->id}}/product_lables_print" target="_blank">
        <div class="row mb-4">

            <div class="col-12">
                @foreach($order->order_data as $item)
                    @if($order->replace_at == null)
                        <div class="row align-items-center mb-4">
                            <div class="col-auto">
                                <input {{$item->product->barcode == null ? 'checked' : ''}} type="checkbox" value="{{$item->product_id}}" name="product[]" id="{{$item->product_id}}">
                            </div>
                            <div class="col-auto">
                                <label for="{{$item->product_id}}">
                                <div class="image image-l" style="width:120px;">
                                    <img class="image-cover" src="{{$item->product->media}}" alt="Demo Image">
                                </div>
                                </label>
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
                                <p class="para">Product ID: P{{$item->product_id}} | {{$item->product->barcode}}</p>
                                @if($item->product->locations->count() > 0)
                                <p class="para">Location: {{implode("," ,$item->product->locations->pluck("loc")->toArray())}}</p>
                                @endif
                            </div>
                        </div>
                    @else
                        @if($item->replace_at != null)
                            <div class="row align-items-center mb-4">
                                <div class="col-auto">
                                    <input {{$item->product->barcode == null ? 'checked' : ''}} type="checkbox" value="{{$item->product_id}}" name="product[]" id="{{$item->product_id}}">
                                </div>
                                <div class="col-auto">
                                    <a href="/product/{{$item->product->product_group_id}}">
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
                                    <p class="para">Product ID: P{{$item->product_id}} | {{$item->product->barcode}}</p>
                                    @if($item->product->locations->count() > 0)
                                    <p class="para">Location: {{implode("," ,$item->product->locations->pluck("loc")->toArray())}}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>

        </div>

        <input class="btn btn-dark" type="submit" value="Print Product Label">
    </form>
</div>

@endsection
