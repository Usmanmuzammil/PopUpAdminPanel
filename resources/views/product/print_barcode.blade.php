<!DOCTYPE html>
<html>
<head>
    <title>Barcode Sticker</title>
    <style>
        /* Adjust the size and layout of the barcode sticker here */

        @media print {
            .barcode-sticker {
                width: auto;
                height: auto;
               // margin: 0px auto;
            // border: 1px solid #000;
                text-align: center;
                font-family: "Nunito", sans-serif;
            }

            .barcode-sticker p {
                margin: 0px 0px 0px 0px;
                font-size: 10px;
                margin-bottom: 2px;
            }



            .break {
                clear: both; /* Add this line */
                page-break-after: always; /* Add this line */
            }
        }

        .barcode-sticker {
            width: auto;
            height: auto;
            margin: 0px auto;
        // border: 1px solid #000;
            text-align: center;
            font-family: "Nunito", sans-serif;

        }

        .barcode-sticker p {
            margin: 0px 0px 0px 0px;
            font-size: 10px;
            margin-bottom: 2px;

        }



        .flex{
            display: flex; /* Add this line */
        }

        .break {
            clear: both; /* Add this line */
            page-break-after: always; /* Add this line */
        }
    </style>
</head>
<body>
{{--@for($i=1; $i<=1; $i++) --}}
<div class="flex">
<div class="barcode-sticker">
    <p><center class="title"><img style="height: 24px; width: 60px;" src="{{asset('img/jugno-gsm.png')}}"/> </center></p>
    <p>{!! $barcode !!}</p>
    <p>CODE: {{ $product->product_code }}</p>
    <p>RS: {{ $product->selling_price }}</p>
</div>

    <div class="barcode-sticker">
        <p><center class="title"><img style="height: 24px; width: 60px;" src="{{asset('img/jugno-gsm.png')}}"/> </center></p>
        <p>{!! $barcode !!}</p>
        <p>CODE: {{ $product->product_code }}</p>
        <p>RS: {{ $product->selling_price }}</p>
    </div>
</div>
{{--
<div class="break"></div>
@endfor
--}}
</body>
</html>
