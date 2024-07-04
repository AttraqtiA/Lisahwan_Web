<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk-{{ $order->id }}</title>
    <link rel="icon" href="/images/lisahwan_logo.png">
</head>

<body style="font-family: 'Montserrat', sans-serif;">
    <div style="display: flex; justify-content: center; align-items: center;">
        <div style="width: 100%; border-radius: 0.375rem; padding: 2rem; ">
            <img src="/images/lisahwan_logo.png" alt="Lisahwan" style=" margin: auto; width: 4rem;" />
            <div style="margin-top: 1rem; padding-bottom: 1rem;">
                <span style="font-size: 1rem; color: black; font-weight: bold;">Lisahwan</span>
                <br>
                <span style="font-size: 0.875rem; color: black; font-style: italic;">Jalan Jemur Andayani XIII No.
                    6</span>
            </div>
            <div
                style="display: flex; flex-direction: column; gap: 1rem; border-bottom: 0.125rem solid black; font-size: 0.875rem;  padding-bottom: 1rem;">
                <span style="display: flex; justify-content: space-between;">
                    <span style="color: black; font-weight: bold;">Order Date:</span>
                    <span>{{ date('d F Y', strtotime($order->order_date)) }}</span>
                </span>
                <br>
                @if ($order->user_id == 1 || $order->user_id == 2)
                    <span style="display: flex; justify-content: space-between;">
                        <span style="color: black; font-weight: bold;">Order Type:</span>
                        <span>In-store Shopping</span>
                    </span>
                @else
                    <span style="display: flex; justify-content: space-between;">
                        <span style="color: black; font-weight: bold;">Order Type:</span>
                        <span>Online Shopping</span>
                    </span>
                @endif
                <br>
                <span style="display: flex; justify-content: space-between;">
                    <span style="color: black; font-weight: bold;">Receipt No.:</span>
                    <span>{{ $order->id }}</span>
                </span>
                <br>
                @if ($order->user_id == 1 || $order->user_id == 2)
                    <span style="display: flex; justify-content: space-between;">
                        <span style="color: black; font-weight: bold;">Host:</span>
                        <span>{{ $order->user->name }}</span>
                    </span>
                @else
                    <span style="display: flex; justify-content: space-between;">
                        <span style="color: black; font-weight: bold;">Customer:</span>
                        <span>{{ $order->user->name }}</span>
                    </span>
                @endif
            </div>
            <div style="display: flex; flex-direction: column; gap: 1rem; font-size: 0.875rem; color: #4b5563;">
                <table style="width: 100%; text-align: left; font-size: 0.875rem;">
                    <thead>
                        <tr style="display: flex;">
                            <th style="flex: 1; padding-top: 0.5rem; text-align: left;">Product</th>
                            <th
                                style="min-width: 2.75rem; padding-top: 0.5rem; padding-left: 5rem; padding-right: 5rem; text-align: left;">
                                QTY</th>
                            <th style="min-width: 2.75rem; padding-top: 0.5rem; text-align: left;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_detail as $order_detail)
                            <tr style="display: flex;">
                                <td style="width: 10rem; padding-bottom: 0.5rem;">{{ $order_detail->product->name }}
                                </td>
                                <td style="width: 2rem; padding-bottom: 0.5rem; text-align: center;">
                                    {{ $order_detail->quantity }}</td>
                                <td style="width: 7rem; padding-bottom: 0.5rem;">{{ $order_detail->price }}</td>
                            </tr>
                        @endforeach
                        <tr style="border-top: 0.125rem solid black;">
                            <td
                                style="font-weight: 600; padding-top: 0.5rem; padding-bottom: 0.5rem; border-top: 0.125rem solid black; font-weight: bold;">
                                Total:
                            </td>
                            <td style=" padding-top: 0.5rem; padding-bottom: 0.5rem; border-top: 0.125rem solid black;">
                            </td>
                            <td
                                style=" padding-top: 0.5rem; padding-bottom: 0.5rem; border-top: 0.125rem solid black; font-weight: bold;">
                                Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="border-bottom: 0.125rem solid black;"></div>
                <div
                    style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding-top: 2rem; gap: 0.5rem; font-size: 0.875rem;">
                    <span style="display: flex; gap: 0.5rem; text-align: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="20"
                            height="20">
                            <path fill="#000" fill-rule="evenodd"
                                d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span style="font-size: 0.875rem;">lisahwan.shop</span>
                    </span>
                    <br>
                    <span style="display: flex; gap: 0.5rem; text-align: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none">
                            <path fill="#000"
                                d="M11.05 14.95L9.2 16.8c-.39.39-1.01.39-1.41.01-.11-.11-.22-.21-.33-.32a28.414 28.414 0 01-2.79-3.27c-.82-1.14-1.48-2.28-1.96-3.41C2.24 8.67 2 7.58 2 6.54c0-.68.12-1.33.36-1.93.24-.61.62-1.17 1.15-1.67C4.15 2.31 4.85 2 5.59 2c.28 0 .56.06.81.18.26.12.49.3.67.56l2.32 3.27c.18.25.31.48.4.7.09.21.14.42.14.61 0 .24-.07.48-.21.71-.13.23-.32.47-.56.71l-.76.79c-.11.11-.16.24-.16.4 0 .08.01.15.03.23.03.08.06.14.08.2.18.33.49.76.93 1.28.45.52.93 1.05 1.45 1.58.1.1.21.2.31.3.4.39.41 1.03.01 1.43zM21.97 18.33a2.54 2.54 0 01-.25 1.09c-.17.36-.39.7-.68 1.02-.49.54-1.03.93-1.64 1.18-.01 0-.02.01-.03.01-.59.24-1.23.37-1.92.37-1.02 0-2.11-.24-3.26-.73s-2.3-1.15-3.44-1.98c-.39-.29-.78-.58-1.15-.89l3.27-3.27c.28.21.53.37.74.48.05.02.11.05.18.08.08.03.16.04.25.04.17 0 .3-.06.41-.17l.76-.75c.25-.25.49-.44.72-.56.23-.14.46-.21.71-.21.19 0 .39.04.61.13.22.09.45.22.7.39l3.31 2.35c.26.18.44.39.55.64.1.25.16.5.16.78z">
                            </path>
                        </svg>
                        <span style="font-size: 0.875rem;">+6282230308030</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
