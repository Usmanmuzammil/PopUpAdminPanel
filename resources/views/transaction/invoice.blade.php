@php
    use NumberToWords\NumberToWords;
    use App\Models\Account;
    $account=new Account();

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
              

<div style="margin:0 auto;">
    @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
    @else
        @php $url = url()->previous(); @endphp
    @endif
   
        
    <div class='col-md-4 m-auto bg-white ' id="receipt-data">
        <div>

            <div class="hidden-print" class="col">
                <div class="d-flex">

                    <a href="{{$url}}" class="btn btn-info w-50"><i class="fa fa-arrow-left"></i> Back</a> 
                    
                    <button onclick="window.print();" class="w-50 btn btn-primary"><i class="dripicons-print"></i>Print</button>
                </div>
                        
                
                <br>
            </div>
        </div>
        <div class="centered py-5">
        
                <!--<img src=" {{ asset('img/pajwa.png') }}" height="120px" width="180px" style="">-->
    
		   
            <h2 style="font-size:20px;">Business Manager</h2>
            <p style="font-size:16px;">
                 <b>Address <br>
             +92xx-xxxxxx</b>
           
            </p>
            <p>Transaction invoice</p>
        </div>
		<table style="border-bottom:0px;margin-bottom:5px;">
		<tr style="border-bottom:0px;">
		<td>

            @foreach ($trs as $trs)
                
        <p style="font-size:12px;"> Date  : {{ $trs->date }}</p>
        {{-- {{$bill->date}} - {{$bill->created_at->format('g:i A');}} --}}
		</td>
		<td>
		<p style="font-size:12px;"> Invoice # :  INV{{ $trs->id }} </p>
		</td>
		</tr>
		

	
		</table>
    
          
 
        
        <table class="table-data">
            
             <tr style="border:dotted 1px black;  text-align:center; width:100%;">
            <th >Transfer By</th>    
            <th >Transfer To</th>    
            <th >Amount</th>    
            <th >balance</th>    
            </tr>
            
            <tbody>
                <tr>
                    <td>{{ $trs->getAccount('from_account') }}</td>
                    <td>{{ $trs->getAccount('to_account') }}</td>
                    <td>{{ $trs->amount }}</td>
                    {{-- <td>{{ $trs->getAccountBalance(3) }}</td> --}}
                    <td>{{ $account->getAccountBalance($trs->to_account) }}</td>
                    
                </tr>
            </tbody>
         		
            
            <!-- </tfoot> -->
        </table>
        @endforeach

        <table>
            <tbody>
               
                <tr><td class="centered" colspan="4" style="padding:10px;">Thank you for shopping with us</td></tr>
             
			 <tr>
				{{-- <td class="centered" colspan="4" style="padding:20px;">{!! $barcode !!} --}}

		</td>
			 </tr>
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
	<br>
	
         <div class="centered" style="margin:10px 0 50px;">
            <small>Developed By <b> YAS SOLUTION </b> for contact 03123731807</small>
        </div> 
    </div>
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