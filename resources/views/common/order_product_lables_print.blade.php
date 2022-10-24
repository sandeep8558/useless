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
            padding: 0.5mm;
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
        .text-xs{ font-size: 1.5mm; }
        .text-sm{ font-size: 2.5mm; }
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
    </style>
</head>
<body>
    @foreach($products as $product)
        <p class="np text-sm text-center">
        <?php
        $name = $product->name . " (".$product->brand.")";
        $name = strlen($name) > 25 ? substr($name, 0, 25) . '..' : $name;

        $unit = "";
        if($product->size != null){
            $unit = $product->size;
        }
        if($product->weight != null){
            $unit = $product->weight;
        }
        ?>
        {{$name}}
        </p>
        <p class="np text-sm text-center" style="margin-bottom:8px;">{{$unit}} - P{{$product->product_id}}</p>
        {!! '<img style="width:90%; height:5mm; padding-left:5%;" src="data:image/png;base64,' . base64_encode($jpg->getBarcode('P'.$product->product_id, $jpg::TYPE_CODE_128)) . '">' !!}
    @endforeach

</body>
</html>
