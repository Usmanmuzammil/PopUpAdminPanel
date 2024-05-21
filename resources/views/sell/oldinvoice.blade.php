@php
use NumberToWords\NumberToWords;
// create the number to words "manager" class
$numberToWords = new NumberToWords();

// build a new number transformer using the RFC 3066 language identifier
$numberTransformer = $numberToWords->getNumberTransformer('en');
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <title>POS | Invoice-print</title>
    {{-- <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            text-transform: capitalize;
        }

        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor: pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }

        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }

        tr {
            border-bottom: 1px dotted #ddd;
        }

        // td,th {padding: 5px 0;width: 50%;}
        td {
            text-align: center;
        }

        table {
            width: 100%;
        }

        tfoot tr th:first-child {
            text-align: left;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        small {
            font-size: 11px;
        }

        tbody td {
    vertical-align: top;
}

        @media print {
            * {
                font-size: 12px;
                line-height: 14px;
                font-weight: bolder;
            }

            td,
            th {
                padding: 3px 0;
            }

            .hidden-print {
                display: none !important;
            }

            @page {
                margin: 0;
            }

            body {
                margin: 0.5cm;
                margin-bottom: 1.6cm;
            }

            tbody::after {
                content: '';
                display: block;
                // page-break-after: always;
                page-break-inside: always;
                page-break-before: avoid;
            }
            tbody td{
                width: 0px;
            }
        }
    </style> --}}
    <style>
          * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dotted #ddd;}
       // td,th {padding: 5px 0;width: 50%;}
	   td {text-align:center;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media print {
            * {
                font-size:12px;
                line-height: 14px;
            }
            td,th {padding: 3px 0;}
            .hidden-print {
                display: none !important;
            }
            @page { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; }
            tbody::after {
                content: '';
                display: block;
               // page-break-after: always;
                page-break-inside: always;
                page-break-before: avoid;
            }
        }
    </style>
</head>

<body style="margin:0px;">
    @php
    $total=0;
    $change=0;
    $bid=0;
    @endphp


    @foreach ($bill as $bill)

    @php
    $total=$bill->total;
    $change=$bill->returned_ammount;
    $remaining=$bill->remaining;
    $bid=$bill->bill_id;
    @endphp
    @endforeach
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 m-auto border bg-white">


    <div style="max-width:100%; margin:0 auto">
        @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
        @else
        @php $url = url()->previous(); @endphp
        @endif

        <div class="hidden-print">
            <table>
                <tr>
                    <td><a href="{{$url}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back</a> </td>
                    <td><button onclick="window.print();" class="btn btn-primary"><i
                                class="dripicons-print"></i>Print</button></td>
                </tr>
            </table>
            <br>
        </div>

        <div id="receipt-data">
            <div class="centered" style="border-bottom: 1px solid black;">

                <!--<img src=" {{ asset('img/pajwa.png') }}" height="120px" width="180px" style="">-->


                <h1 style="font-weight: bolder">PopUp Food</h1>
                <small style="font-size:16px;">
                    <b>
                        0335-1349990 | 0304-0396883
                        <br>
                    </b>
                        <small> <b> Near Dawood mart Main Autobhan Road </b></small> <br>
                        <small>We prepare freshly baked waffles just for you,<br>  kindly allow a  few moments for perfection.</small>
                </small>

            </div>
            <div class="row mt-2">

                <div class="col-6">
                    <small style="font-size:12px;"> {{$bill->date}} - {{$bill->created_at->format('g:i
                    A');}} </small>
                    <br>
                    <p style="font-size:12px;"> Order # : <b> {{$bill->id}} </b></p>

                </div>
                <div class="col-6 ">
                    <small style="font-size:12px;">Customer : <Strong>{{ ($bill->name!=null)?$bill->name:"Walk-in" }}</Strong> </small>

                    <p style="font-size:12px;"> Type : <b>{{$bill->order_type}} </b></p>

                </div>
            </div>





            <table class="table-data">

                <tr style="border:dotted 1px black;text-align:center; width:100%;">
                    <th style="width:10%">Qty</th>
                    <th style="width:25%;text-align:start;">Item Name</th>
                    <th style="width:20%">Price</th>
                    <th style="width:10%">Disc</th>
                    <th style="width:20%">Tot</th>
                </tr>

                <tbody>

                    @foreach ($bill_detail as $bill_detail)



                    <tr >
                        <td  style="text-align:center;" >{{$bill_detail->qty}}</td>
                        <td style="text-align:start;"> {{ $bill_detail->getproduct->product_name }} <br>
                        {{-- {{ $bill_detail->displayVariants($bill_detail->displayVariants()) }} --}}
                            <?php
                            // echo $bill_detail->displayVariants($bill_detail->displayVariants());
                            echo $bill_detail->displayExtras($bill_detail->displayExtras());
                            echo $bill_detail->displayAddons($bill_detail->displayAddons());
                            ?>
                        </td>
                        <td style="text-align:center;" >{{$bill_detail->price}}</td>
                        <td class="">{{$bill_detail->discount}}</td>
                        <td>{{number_format((float)$bill_detail->net_total, 2, '.', '')}}</td>

                    </tr>

                    @endforeach

                </tbody>


                <tfoot>
                    @if ($bill->discount>0)


                    <tr style="font-size:18px;  border-top:1px solid black;">
                        <th colspan="4" style="text-align:left; padding:10px;">Total</th>
                        <th style="text-align:center">{{number_format((float)$bill->total, 2, '.', '')}}</th>

                    </tr>

                    <tr style="font-size:18px;  border-top:1px solid black;">
                        <th colspan="4" style="text-align:left; padding:10px;">Discount</th>
                        <th style="text-align:center">{{number_format((float)$bill->discount, 2, '.', '')}}</th>
                    </tr>
                    @endif
                    <tr style="font-size:18px;  border-top:1px solid black;">
                        <th colspan="4" style="text-align:left; padding:10px;">Net Total</th>
                        <th style="text-align:center">{{number_format((float)$bill->net_total, 2, '.', '')}}</th>
                    </tr>


                    <tr>
                        <td class="centered" colspan="6" style="padding:3px;">
                            Thanks For Coming, Visit Our Site
                            <br>
                            <b>
                                 www.thepopupfood.com </b></td>
                    </tr>

                    </tbody>
                    <!-- </tfoot> -->
            </table>
            <table>
                <tbody>

                    {{-- <tr class="centered">
                        <td style="width:40%">Paid : <b>{{number_format((float)$bill->paid_amount, 2, '.', '')}}</b>
                        </td>
                        <td style="width:40%">Due : <b>{{number_format((float)$bill->remaining, 2, '.', '')}}</b></td>
                    </tr> --}}

                    {{-- <td style="width:30%">Change : <b>{{number_format((float)$bill->change, 2, '.', '')}}</b></td> --}}





                </tbody>
            </table>

            <!--	<table>
		<tr>
		<td>

	 CONGRATS , YOU GET A COUPON

		</td>
		</tr>
		<tr>
		<td>
		YOUR COUPON NUM?BER is <b> " X7844P " </b>
		</td>
		</tr>


		</table -->


            <div class="centered mb-1" style="margin-top:0px;">
                <small>Developed By <b> YAS SOLUTION |</b> contact 03123731807</small>
            </div>
        </div>
    </div>
</div>
</div>
</div>

    <script type="text/javascript">
        localStorage.clear();
    function auto_print() {
        // window.print()
    }
    setTimeout(auto_print, 1000);
    </script>


<script>
    window.print()
</script>
</body>

</html>
