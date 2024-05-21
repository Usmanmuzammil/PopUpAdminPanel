@extends('order-booker-pannel.layouts.master')
@section('content')
<head>

    <style>
        @media print {
            button {
                display: none;
            }
        }
        @page {
    size: A4;
    margin: 1cm;
    header: "Your Header Text";
    footer: "Page " counter(page) " of " counter(pages);
}
@media print {
        .print-button {
            display: none;
        }
        header{
            display: none;
        }
        .footer-fixed{
            display: none;
        }

    }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        </head>
<div class="page-content space-top p-b50">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab" tabindex="0">
            <div class="container">
                <div class="card">
                    <a href="javascript:void(0);" class="btn btn-primary print-button btn-sm rounded-0" onclick="window.print()">Print</a>

                    <div id="print-content">

                    <table class="table table-striped" id="">
                        <thead>
                            <tr>
                                <td colspan="4">
                            <h4 class="text-center text-primary">FOOD POPUP</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <span class="text-center badge bg-primary">{{ $date }}</span>                                </td>


                            </tr>

                            <tr>
                                <th>Sr</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $order->date }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>RS {{ $order->net_total }}</td>
                                </tr>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td >{{ $orders->sum('net_total') }}</td>
                                </tr>
                            </tfoot>

                        </tbody>
                    </table>
                </div>

                </div>
            </div>
        </div>
    </div>
    @push('script')
    {{-- <script>
         function printContent() {
        // Open a new window with the print-friendly content
        var printWindow = window.open('', '_blank');
        var printContent = document.querySelector('.print-section').innerHTML;

        // Define the HTML structure for the new window
        var printHTML = `
            <html>
                <head>
                    <title>Print</title>
                </head>
                <body>
                    ${printContent}
                </body>
            </html>
        `;

        // Write the HTML to the new window
        printWindow.document.open();
        printWindow.document.write(printHTML);
        printWindow.document.close();

        // Add print-specific CSS to hide unwanted elements
        var style = printWindow.document.createElement('style');
        style.innerHTML = `
            @media print {
                /* Define CSS to hide unwanted elements */
                body * {
                    display: none;
                }
                .print-section, .print-section * {
                    display: block !important;
                }
            }
        `;
        printWindow.document.head.appendChild(style);

        // After the window is open, trigger the print dialog
        printWindow.print();

        // Close the new window after printing (optional)
        // printWindow.close();
    }
    </script> --}}

    @endpush

@endsection