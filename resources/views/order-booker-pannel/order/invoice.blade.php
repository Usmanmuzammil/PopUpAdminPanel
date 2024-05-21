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
    <style type="text/css">
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



        table {
            width: 100%;
        }




        @media print {
            * {
                font-size: 9px;
                font-weight: bold;
                /* line-height: 14px; */
            }

            @page {
                size: 8.5in 5.5in;
                size: portrait;
                /* padding: 0; */
                /* margin: 0; */


            }

            table{
                width: 100%;

            }




            .hidden-print {
                display: none !important;
            }




        }
    </style>



</head>

<body >





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
                    <button onclick="window.print();" class="btn btn-primary"><i
                        class="dripicons-print"></i>Print</button></td>
                    </div>


                    <div id="receipt-data">
                        <div class="">

                            <h2 style="font-size:20px;text-align: center;">Food POPUP</h2>

                        </div>

                             <table class="table-data" >
                            <thead>
                                <tr>

                                    <td colspan="2">
                                        <p >{{ $bill->date}} -
                                            {{$bill->created_at->format('g:i
                                            A');}} </p>
                                    </td>
                                    <td colspan="2">
                                        <p>Order #:{{$bill->id}} </p>
                                    </td>
                                </tr>

                                <tr style="border-bottom: 1px solid black;">
                                    <th >Qty</th>
                                    <th >Item</th>
                                    <th >Price</th>
                                    <th >Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($bill_detail as $bill_detail)



                                <tr >
                                    <td>{{$bill_detail->qty}}</td>
                                    <td > {{ $bill_detail->getproduct->product_name }}
                                        {{-- {{ $bill_detail->displayVariants($bill_detail->displayVariants()) }} --}}
                                        <?php
                            echo $bill_detail->displayVariants($bill_detail->displayVariants());
                            echo $bill_detail->displayExtras($bill_detail->displayExtras())."<br>";
                            echo $bill_detail->displayAddons($bill_detail->displayAddons());
                            ?>
                                    </td>
                                    <td >{{$bill_detail->price}} </td>

                                    <td >{{number_format((float)$bill_detail->net_total, 2, '.', '')}}
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                              <tfoot>

                                <tr style="border-top: 1px solid black;border-bottom: 1px solid black;">
                                    <th colspan="3">Net Total</th>
                                    <th >{{number_format((float)$bill->net_total, 2, '.', '')}}
                                    </th>
                                </tr>
                            </tfoot>

                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')

    <script>
        window.addEventListener("popstate", function(event) {
    window.location.replace("{{ route('home') }}"); // Redirect to the home page
});



    </script>
    @endpush
    <script type="text/javascript">
        function redirect() {
        // window.print()
        window.location.href="{{ route('order-booker.dashboard') }}"
    }


    function invoice(){

    }
    // setTimeout(redirect, 10000);
    url = 'app://data=';

    </script>

</body>

</html>
