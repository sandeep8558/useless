<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        html, .np {
            margin: 0;
            padding: 0;
            
        }
        body {
            width:70mm;
            padding: 4mm;
            background-color:#ffffff;
            font-family: courier;
            color: #000000;
        }
        .page-break {
            page-break-after: always;
        }

        .text-xs{ font-size: 2.5mm; }
        .text-sm{ font-size: 2.75mm; }
        .text-md{ font-size: 3mm; }
        .text-lg{ font-size: 3.5mm; }
        .text-xl{ font-size: 4mm; }
        .text-bold { font-weight: bold; }
        .text-left { text-align:left; }
        .text-center { text-align:center; }
        .text-right { text-align:right; }
        .text-justify { text-align:justify; }

        .p-xs { padding: 0.5mm; }
        .p-sm { padding: 1mm; }
        .p-md { padding: 2mm; }
        .p-lg { padding: 3mm; }
        .px-sm { padding: 0mm 1mm; }
        .px-md { padding: 0mm 2mm; }
        .px-lg { padding: 0mm 3mm; }
        .py-sm { padding: 1mm 0mm; }
        .py-md { padding: 2mm 0mm; }
        .py-lg { padding: 3mm 0mm; }
        table {
            border-collapse: collapse;
        }
        .table, .table td, .table th {
            border: 0px solid #999999;
            color: #000000;
        }
    </style>
</head>
<body>

<div class="text-md text-center" style="width:70mm;">
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/print_logo.jpg'))) }}" style="width:50px;">
    <h3>Vainkho Ecommerce Private Limited</h3>
    <p>Vainkho Warehouse No 4, Sarvodaya Nagar, Jambhul Road Ambernath West 421501 MS India.</p>
    <p>vainkho.com@gmail.com | 91-7711076777</p>
    <p>GST NO - 27AAHCV6019L1ZW</p>
    <p>FSSAI - 21521108001884</p>
</div>

<hr style="margin:5mm 0mm">

<div class="text-md" style="display:inline-block; width:35mm;">
    <p>OID : {{$order->id}}</p>
</div>

<div class="text-md text-right" style="display:inline-block; width:35mm;">
    <p>Date : {{date('d-m-Y', strtotime($order->created_at))}}</p>
</div>

<div class="text-md text-left" style="width:70mm;">
    <p>SHIP TO</p>
    <h3>{{$order->address->fullname}} ({{$order->user_id}})</h3>
    <p>{{$order->address->address}} {{$order->address->city}} {{$order->address->pincode}} {{$order->address->state}} {{$order->address->country}}</p>
    <p>{{$order->address->mobile}} | {{$order->address->email}}</p>
</div>

<hr style="margin:5mm 0mm">

<table style="width:70mm;" class="table text-sm">
    <tr>
        <th style="width:34mm; padding: 3px 0px; text-align: left;">Particular</th>
        <th style="width:6mm; padding: 3px 0px;">Qty</th>
        <th style="width:10mm; padding: 3px 0px; text-align: right;">MRP</th>
        <th style="width:10mm; padding: 3px 0px; text-align: right;">Rate</th>
        <th style="width:10mm; padding: 3px 0px; text-align: right;">Total</th>
    </tr>
    @foreach($order->order_data as $product)
    <tr>
        <td style="padding: 3px 0px; text-align: left;">{{$product->name}} ({{$product->size != null ? $product->size : ''}}{{$product->weight != null ? $product->weight : ''}})</td>
        <td style="padding: 3px 0px; text-align: center;">{{$product->qty}}</td>
        <td style="padding: 3px 0px; text-align: right;">{{$product->mrp}}</td>
        <td style="padding: 3px 0px; text-align: right;">{{$product->rate}}</td>
        <td style="padding: 3px 0px; text-align: right;">{{$product->total_rate}}</td>
    </tr>
    @endforeach
</table>

<hr style="margin:5mm 0mm">

<table style="width:70mm;" class="table text-md">
    <tr>
        <td style="width:50mm; padding: 2mm 0mm; text-align: right;">MRP Total</td>
        <td style="width:20mm; padding: 2mm 0mm; text-align: right; ">{{$order->mrp_total}}</td>
    </tr>
    <tr>
        <td style="width:50mm; padding: 2mm 0mm; text-align: right;">Delivery Charges</td>
        <td style="width:20mm; padding: 2mm 0mm; text-align: right;">{{$order->delivery}}</td>
    </tr>
    <tr>
        <td style="width:50mm; padding: 2mm 0mm; text-align: right;">Total Price (Tax Included)</td>
        <td style="width:20mm; padding: 2mm 0mm; text-align: right;">{{$order->price_total}}</td>
    </tr>
    <tr>
        <td style="width:50mm; padding: 2mm 0mm; text-align: right;">Total Taxes</td>
        <td style="width:20mm; padding: 2mm 0mm; text-align: right;">{{$order->tax}}</td>
    </tr>
    <tr>
        <td style="width:50mm; padding: 2mm 0mm; text-align: right;">Special Discount</td>
        <td style="width:20mm; padding: 2mm 0mm; text-align: right;">{{$order->discount}}</td>
    </tr>
    <tr>
        <td style="width:50mm; padding: 2mm 0mm; text-align: right;">Your Savings</td>
        <td style="width:20mm; padding: 2mm 0mm; text-align: right;">{{$order->saving}}</td>
    </tr>
    <tr>
        <td style="width:50mm; padding: 2mm 0mm; text-align: right; font-weight: bold;">Payable Amount</td>
        <td style="width:20mm; padding: 2mm 0mm; text-align: right; font-weight: bold;">{{$order->payable}}</td>
    </tr>
</table>

<hr style="margin:5mm 0mm">

<div class="text-md text-center" style="width:70mm;">
    <h3>Thank You</h3>
</div>

</body>
</html>
