<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html, .np {
            margin: 0;
            padding: 0;
        }
        body {
            padding: 10px 10px 0px 10px;
            width:268px;
        }
        .page-break {
            page-break-after: always;
        }
        .table, .table td {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #999999;
        }
        .table td {
            padding: 1mm;
        }
        .text-sm{ font-size: 2.5mm; }
        .text-md{ font-size: 3mm; }
        .text-lg{ font-size: 3.5mm; }
        .text-xl{ font-size: 4mm; }
        .text-bold { font-weight: bold; }
        .text-left { text-align:left; }
        .text-center { text-align:center; }
        .text-right { text-align:right; }
        .text-justify { text-align:justify; }
        .p-sm { padding: 1mm; }
        .p-md { padding: 2mm; }
        .p-lg { padding: 3mm; }
        .px-sm { padding: 0mm 1mm; }
        .px-md { padding: 0mm 2mm; }
        .px-lg { padding: 0mm 3mm; }
        .py-sm { padding: 1mm 0mm; }
        .py-md { padding: 2mm 0mm; }
        .py-lg { padding: 3mm 0mm; }
    </style>
</head>
<body>

    <table class="table np">
        <tr class="np">
            <td class="np" style="height:20px;">
                <p style="font-size:12px;" class="np text-bold">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/print_logo.jpg'))) }}" style="width:20px; vertical-align:top;">
                    VAINKHO ECOMMERCE PVT LTD
                </p>
            </td>
        </tr>
        <tr>
            <td class="np" style="height:78px;">
            <p style="font-size:11px;" class="np text-bold">{{$order->address->fullname}}</p>
            <p style="font-size:11px;" class="np">{{$order->address->address}} {{$order->address->city}} {{$order->address->pincode}} {{$order->address->state}} {{$order->address->country}}</p>
            <p style="font-size:11px;" class="np">{{$order->address->email}} | {{$order->address->mobile}}</p>
            </td>
        </tr>
        <tr>
            <td class="np" style="height:25px; padding: 10px 5px 5px 5px">
                {!! '<img style="height:20px; max-width:200px;" src="data:image/png;base64,' . base64_encode($barcode->getBarcode($order->id, $barcode::TYPE_CODE_128)) . '">' !!}
                <p style="font-size:10px;" class="np">Order ID - {{$order->id}}</p>
            </td>
        </tr>

        <tr class="np">
            <td class="np" style="height:22px;">
                <p style="font-size:11px;" class="np text-bold">Rs. {{$order->payable}}/- | Payment Mode - {{$order->paymentmode}}</p>
            </td>
        </tr>
    </table>

</body>
</html>
