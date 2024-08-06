<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Label Pengiriman</title>
    <link rel="icon" href="/images/lisahwan_logo.png">
</head>

<body style="font-family: 'Montserrat', sans-serif; margin: 0; padding: 0;" width="100%">
    <div style="width: 100%; height: 100%; padding: 1rem; padding-right: 0rem;">
        <div style="text-align: center; margin-bottom: 2mm;">
            <h1 style="margin: 0; font-size: 14pt;">Label Pengiriman</h1>
        </div>
        <div style="margin-bottom: 2mm;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td>
                        <div>
                            <p style="margin: 0; font-size:10pt;"><strong>Penerima:</strong></p>
                            <p style="margin: 0; font-size:10pt;">{{ $order->user->name }}</p>
                            <p style="margin: 0; font-size:10pt;">{{ $order->user->phone_number }}</p>
                            <p style="margin: 0; font-size:10pt;">{{ $order->address->address }},
                                {{ $order->address->city }}, {{ $order->address->province }},
                                {{ $order->address->postal_code }}</p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p style="margin: 0; font-size:10pt;"><strong>Pengirim:</strong></p>
                            <p style="margin: 0; font-size:10pt;">Lisahwan</p>
                            <p style="margin: 0; font-size:10pt;">082230308030</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin: 0; font-size:10pt;"><strong>Kurir:</strong></p>
                        <p style="margin: 0; font-size:10pt;">{{ $order->shipment_service }} ({{ $order->total_weight }} gram)</p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="margin-bottom: 0mm;">
            <p style="margin: 0; margin-bottom: 1mm; font-size: 8pt;"><strong>Detail Pesanan:</strong></p>
            <table style="width: 100%; border-collapse: collapse; font-size: 8pt; border: 1px solid #000;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000; padding: 0.5mm; text-align: left;" width="50%">Produk</th>
                        <th style="border: 1px solid #000; padding: 0.5mm; text-align: left;" width="50%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_detail as $order_detail)
                        <tr>
                            <td style="border: 1px solid #000; padding: 0.5mm;">{{ $order_detail->product->name }}</td>
                            <td style="border: 1px solid #000; padding: 0.5mm;">{{ $order_detail->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="margin: 0; margin-top: 1mm; font-size: 8pt;"><strong>Total Produk:
                    {{ $order->order_detail->sum('quantity') }}</strong></p>
        </div>
        <div style="text-align: center; border-top: 1px solid #000; padding-top: 2mm; margin-top: 4mm;">
            {{-- <p style="margin: 0; margin-bottom: 1mm; font-size: 10pt; text-align: center;"><strong>ISI MUDAH PECAH,
                    JANGAN DIBANTING!</strong></p> --}}
            <img src="{{ url('/images/lisahwan_text.png') }}" alt="Lisahwan"
                style="filter: contrast(150%) drop-shadow(2px 2px 2px black);" width="110px">
        </div>
    </div>
</body>

</html>
