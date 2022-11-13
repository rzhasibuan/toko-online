<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data order</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: rgb(90, 2, 252);
            color: white;
        }
        tr:hover {background-color: #f5f5f5;}
        .title{
            text-align: center;
        }
    </style>
</head>
<body>
<p class="title">{{ config('app.name', 'Laravel') }} <br>
    LAPORAN DATA ORDER <br>
    BULAN

    @if($bulan == 1)
            JANUARI
    @elseif($bulan == 2)
             FEBRUARI
     @elseif($bulan == 3)
            MARET
    @elseif($bulan == 4)
            APRIL
    @elseif($bulan == 5)
            MEI
    @elseif($bulan == 6)
            JUNI
    @elseif($bulan == 7)
            JULI
    @elseif($bulan == 8)
            AGUSTUS
    @elseif($bulan == 9)
            SEPTEMBER
    @elseif($bulan == 10)
            OKTOBER
    @elseif($bulan == 11)
            NOVEMBER
    @elseif($bulan == 12)
            DESEMBER
    @endif

</p>
@php
    $no = 1;
@endphp
<table>
    <tr>
        <th>{{ __('field.order_invoice') }}</th>
        <th>{{ __('field.order_customer') }}</th>
        <th>{{ __('field.order_total') }}</th>
        <th>{{ __('field.order_status') }}</th>
        <th>{{ __('field.created_at') }}</th>
    </tr>
    @foreach ($data as $order)
        <tr>
            <td>{{ $order->invoice_number }}</td>
            <td>{{ $order->recipient_name }}</td>
            <td>{{ $order->total_pay }}</td>
            <td>
                @if($order->status == 0)
                Pending
                @elseif($order->status == 1)
                Dikemas
                @elseif($order->status == 2)
                Dikirim
                @elseif($order->status == 3)
                Selesai
                @elseif($order->status == 4)
                Dibatalkan
                @else{
                Kadaluarsa
                @endif
            </td>
            <td>{{ $order->created_at }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
