@extends('layouts.frame_nocarousel')

@section('content_page')
    <div class="flex flex-col p-12 mx-auto justify-center items-center gap-y-6">
        @foreach ($orders as $order)
        <form action="/orderhistory/{{ $order->id }}" method="POST">
            @method('patch')
            @csrf
            <div class="flex flex-col bg-white justify-center rounded-lg border border-gray-300 drop-shadow-md">
                <div class="flex flex-row p-6 justify-center items-center gap-x-8">
                    <div class="flex flex-col justify-center items-start">
                        <p class="text-sm font-semibold text-gray-900">
                            Tanggal Pemesanan:
                        </p>
                        <p class="text-xs font-medium text-gray-400">
                            {{ date('d F Y', strtotime($order->order_date)) }}
                        </p>
                    </div>
                    <div class="flex flex-col justify-center items-start">
                        <p class="text-sm font-semibold text-gray-900">
                            Tanggal Pengiriman:
                        </p>
                        @if ($order->shipment_date)
                            <p class="text-xs font-medium text-gray-400">
                                {{ date('d F Y', strtotime($order->shipment_date)) }}
                            </p>
                        @else
                            <p class="text-xs font-medium text-gray-400">
                                -
                            </p>
                        @endif
                    </div>
                    <div class="flex flex-col justify-center items-start">
                        <p class="text-sm font-semibold text-gray-900">
                            Tanggal Sampai:
                        </p>
                        @if ($order->arrived_date)
                            <p class="text-xs font-medium text-gray-400">
                                {{ date('d F Y', strtotime($order->arrived_date)) }}
                            </p>
                        @else
                            <p class="text-xs font-medium text-gray-400">
                                -
                            </p>
                        @endif
                    </div>
                    <div class="flex flex-col justify-center items-start">
                        <p class="text-sm font-semibold text-gray-900">
                            Total Pemesanan:
                        </p>
                        <p class="text-xs font-medium text-lime-600">
                            Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="flex flex-col justify-center items-start">
                        @if ($order->acceptbyAdmin_status)
                            <span
                                class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-3 py-1.5 rounded-lg">
                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                Pesanan Diterima
                            </span>
                        @else
                            <span
                                class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-3 py-1.5 rounded-lg">
                                <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                Pesanan Belum Diterima
                            </span>
                        @endif
                    </div>
                    <div class="flex flex-col justify-center items-start">
                        @if ($order->shipment_status)
                            <span
                                class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-3 py-1.5 rounded-lg">
                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                Sedang Dikirim
                            </span>
                        @else
                            <span
                                class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-3 py-1.5 rounded-lg">
                                <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                Belum Dikirim
                            </span>
                        @endif
                    </div>
                </div>
                <hr class="h-px border-0 bg-gray-300">
                @foreach ($order->order_detail as $order_detail)
                    <div class="flex flex-row items-center justify-center w-full p-7">
                        <img class="h-40 w-40 object-cover object-bottom rounded-lg drop-shadow-md"
                            src="/images/fotoproduk/{{ $order_detail->product->image }}"
                            alt="{{ $order_detail->product->name }}">
                        <div class="flex flex-col ml-3 justify-center space-y-10">
                            <div class="felx flex-col">
                                <p class="text-base font-semibold text-gray-900">{{ $order_detail->product->name }}</p>
                                <p class="text-sm font-normal text-gray-600">{{ $order_detail->product->description }}</p>
                                <p class="mt-2 text-sm font-normal text-gray-600">({{ $order_detail->product->weight }}
                                    gram)</p>
                            </div>
                            <div class="flex flex-row justify-between items-center">
                                <div class="flex flex-col justify-center">
                                    <a href="/products/{{ $order_detail->product_id }}">
                                        <button type="button"
                                            class="cursor-pointer text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-md text-sm sm:text-sm md:text-sm lg:text-sm px-2 py-1 inline-flex items-center">
                                            <svg class="w-4 h-4 sm:mr-1 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                                              </svg>
                                            <span class="sm:inline-block">Lihat Produk</span>
                                        </button>
                                    </a>
                                    @if ($order_detail->product->discount != 0)
                                        <p class="mt-1 text-base font-semibold text-gray-900"> Rp.
                                            {{ number_format($order_detail->product->countDiscount(), 0, ',', '.') }}</p>
                                    @else
                                        <p class="mt-1 text-base font-semibold text-gray-900"> Rp.
                                            {{ number_format($order_detail->product->price, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                                <span
                                    class="inline-flex justify-center items-center bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1.5 rounded border border-yellow-500"><svg
                                        class="w-3 h-3 mr-1 text-yellow-800 dark:text-yellow-800" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg> {{ $order_detail->quantity }} buah (Rp.
                                    {{ number_format($order_detail->price, 0, ',', '.') }})</span>
                            </div>
                        </div>
                    </div>
                    <hr class="h-px border-0 bg-gray-300">
                @endforeach
                <div class="flex flex-col items-center justify-center">
                    <button type="submit"
                        class="cursor-pointer text-green-500 bg-gray-900 hover:bg-gray-800 font-medium rounded-b-lg text-sm sm:text-sm md:text-sm lg:text-sm p-5 inline-flex justify-center items-center w-full"
                        onclick="return confirm('Apakah anda yakin pesanan ini sudah sampai?')">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="sm:inline-block">Pesanan Sampai</span>
                    </button>
                </div>
            </div>
        </form>
        @endforeach
        {{ $orders->links() }}
    </div>
@endsection
