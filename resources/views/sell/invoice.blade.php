<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> --}}

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
            background: white;
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

        @media print {
            * {
                font-size: 12px;
                line-height: 14px;
            }
            #main{
                width: 100%;
                margin: 0px;
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
        }

        table.order-info {

            margin-bottom: 2px;
            border: 0px;
        }

        table.order-info td {
            padding: 0;
            border: 0px;
        }
        #main {
        max-width: 50%;
        margin: auto;
    }

    @media print {
        #main {
            max-width: 100%;
            margin: auto;
        }
    }
    </style>
</head>

<body style="margin:0px;">



    <div id="main" style="margin-top: 40px;">
        <div class="hidden-print">
            <table>
                <tr>
                    <td><a href="{{ url()->previous() }}" class="btn btn-info"><i
                                class="fa fa-arrow-left"></i> Back</a> </td>
                    <td><button onclick="window.print();" class="btn btn-primary"><i
                                class="dripicons-print"></i>Print</button></td>
                </tr>
            </table>
            <br>
        </div>
        @foreach ($bill as $bill)
        <div id="receipt-data">
            <div class="centered" >

                <!--<img src=" https://bm.yas-solution.com/img/pajwa.png" height="120px" width="180px" style="">-->


                <h2 style="font-size:20px;">PopUp Food</h2>
                <p style="font-size:16px;padding: 0px;margin: 0px;">
                    <b>Near Dawood mart Main Autobhan Road </b>
                    <br>
                    <b> 0335-1349990 | 0304-0396883</b>

                </p>
                <br>

                <small style="font-weight: bold;">We prepare freshly baked waffles just for you,<br> kindly allow a few moments for
                    perfection.</small>

            </div>

            <div class="row mt-2" style="display: flex;justify-content:space-around;margin-top: 3px;font-weight: bold;border-top: 2px solid black;">

                <div class="col-4 text-center" style="margin: 0;">
                    <small style="font-size:12px;"> {{$bill->date}} - {{$bill->created_at->format('g:i
                    A');}} </small>
                    <br>
                    <p style="font-size:12px;"> Order # : <b> {{$bill->id}} </b></p>

                </div>
                <div class="col-4 text-center">
                    <small style="font-size:12px;">Customer : <Strong>{{ ($bill->name!=null)?$bill->name:"Walk-in" }}</Strong> </small>

                    <p style="font-size:12px;"> Type : <b>{{$bill->order_type}} </b></p>

                </div>
                <div class="col-4 text-center">
                    <small style="font-size:12px;">Order Booker : <Strong>{{ $bill->getBooker->name }}</Strong> </small>

                    <p style="font-size:12px;"> Type : <b>{{$bill->order_type}} </b></p>

                </div>

            </div>




            <table class="table-data">

                <tr style="border:dotted 1px black;  text-align:center; width:100%;">
                    <th style="width:10%">Qty</th>
                    <th style="width:30%">Item Name</th>
                    <th style="width:20%">Price</th>
                    <th style="width:10%">Disc</th>
                    <th style="width:20%">Tot</th>
                </tr>

                <tbody>


                    @foreach ($bill_detail as $bill_detail)


                    <tr>


                        <td>{{$bill_detail->qty}}</td>
                        <td style="text-align:start;"> {{ $bill_detail->getproduct->product_name }} <br>
                            <?php
                            echo $bill_detail->displayVariants($bill_detail->displayVariants());
                            echo $bill_detail->displayExtras($bill_detail->displayExtras());
                            echo $bill_detail->displayAddons($bill_detail->displayAddons());
                            ?>
                        </td>
                        <td>{{$bill_detail->price}}</td>
                        <td class="">{{$bill_detail->discount}}</td>
                        <td>{{number_format((float)$bill_detail->net_total, 2, '.', '')}}</td>

                    </tr>

                    @endforeach
                </tbody>


                <tfoot>
                    <tr style="font-size:18px;  border-top:2px solid black;">
                        <th colspan="4" style="text-align:left; padding:10px;">Net Total</th>
                        <th style="text-align:center">{{number_format((float)$bill->net_total, 2, '.', '')}}</th>
                    </tr>
                    </tbody>
                    <!-- </tfoot> -->
            </table>
            <table>
                <tbody>

                    <tr>
                        <td class="centered" colspan="6" style="padding:3px;">
                            Thanks For Coming, Visit Our Site
                            <br>
                            <b>
                                www.thepopupfood.com </b>
                        </td>
                    </tr>

                </tbody>
            </table>



            <div class="centered" style="margin:10px 0 50px;">
                <small>Developed By <b> YAS SOLUTION </b> for contact 03123731807</small>
            </div>
            <br>
            <br>
        </div>
        @endforeach
    </div>

    <script type="text/javascript">
        localStorage.clear();
    function auto_print() {
        window.print()
    }
    setTimeout(auto_print, 1000);
    </script>

</body>

</html>