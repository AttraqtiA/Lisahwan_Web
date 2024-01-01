<div id="order-detail{{ $order->id }}"
    class="fixed top-0 left-0 z-50 h-screen pt-4 overflow-y-auto transition-transform -translate-x-full bg-gray-800 w-full md:w-80"
    tabindex="-1" aria-labelledby="drawer-label">
    <h5 id="drawer-label" class="pl-4 inline-flex items-center mb-4 text-base font-semibold text-gray-400">
        <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>Info Order
    </h5>
    <button type="button" data-drawer-hide="order-detail{{ $order->id }}"
        aria-controls="order-detail{{ $order->id }}"
        class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center hover:bg-gray-600 hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>


    <div class="md:px-4 flex flex-col bg-white justify-center border border-gray-300 drop-shadow-md">
        <div class="ml-2 md:ml-0 grid grid-cols-2 py-4 px-2 gap-x-8 gap-y-4">
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
                @if ($order->acceptbyAdmin_status == 'sudah')
                    <span
                        class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2 py-1.5 rounded-lg">
                        <span class="w-2.5 h-2 mr-2 bg-green-500 rounded-full"></span>
                        Sudah Diterima
                    </span>
                @else
                    <span
                        class="inline-flex items-center bg-gray-300 text-gray-600 text-xs font-medium px-2 py-1.5 rounded-lg">
                        <span class="w-2.5 h-2 mr-2 bg-gray-600 rounded-full"></span>
                        Belum Diterima
                    </span>
                @endif
            </div>
            <div class="flex flex-col justify-center items-start">
                @if ($order->shipment_status == 'sudah')
                    <span
                        class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2 py-1.5 rounded-lg">
                        <span class="w-2.5 h-2 mr-2 bg-green-500 rounded-full"></span>
                        Sedang Dikirim
                    </span>
                @else
                    <span
                        class="inline-flex items-center bg-gray-300 text-gray-600 text-xs font-medium px-2 py-1.5 rounded-lg">
                        <span class="w-2.5 h-2 mr-2 bg-gray-600 rounded-full"></span>
                        Belum Dikirim
                    </span>
                @endif
            </div>
            <div class="flex flex-col justify-center items-start">
                @if ($order->acceptbyCustomer_status == 'sudah')
                    <span
                        class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2 py-1.5 rounded-lg">
                        <span class="w-3 h-2 mr-2 bg-green-500 rounded-full"></span>
                        Sudah Sampai
                    </span>
                @else
                    <span
                        class="inline-flex items-center bg-gray-300 text-gray-600 text-xs font-medium px-2 py-1.5 rounded-lg">
                        <span class="w-2.5 h-2 mr-2 bg-gray-600 rounded-full"></span>
                        Belum Sampai
                    </span>
                @endif
            </div>
        </div>

        <hr class="h-px border-0 bg-gray-300">

        @foreach ($order->order_detail as $order_detail)
            <div class="flex flex-col items-center justify-center w-full p-4">
                <img class="mb-4 h-40 w-40 object-cover object-bottom rounded-lg drop-shadow-md"
                    src="/images/fotoproduk/{{ $order_detail->product->image }}"
                    alt="{{ $order_detail->product->name }}">
                <div class="flex flex-col justify-center space-y-10">
                    <div class="flex flex-col">
                        <p class="text-base font-semibold text-gray-900">
                            {{ $order_detail->product->name }}</p>
                        <p class="text-sm font-normal text-gray-600">
                            {{ $order_detail->product->description }}</p>
                        <p class="mt-2 text-sm font-normal text-gray-600">
                            ({{ $order_detail->product->weight }}
                            gram)
                        </p>
                    </div>
                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-col justify-center">
                            <a href="/products/{{ $order_detail->product_id }}">
                                <button type="button"
                                    class="cursor-pointer text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-md text-sm sm:text-sm md:text-sm lg:text-sm px-2 py-1 inline-flex items-center">
                                    <svg class="w-4 h-4 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                        <path
                                            d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                                    </svg>
                                    <span class="ml-2 md:ml-1 sm:inline-block">Lihat
                                        Produk</span>
                                </button>
                            </a>
                            @if ($order_detail->product->discount != 0)
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    Rp.
                                    {{ number_format($order_detail->product->countDiscount(), 0, ',', '.') }}
                                </p>
                            @else
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    Rp.
                                    {{ number_format($order_detail->product->price, 0, ',', '.') }}
                                </p>
                            @endif
                        </div>
                        <span
                            class="ml-8 inline-flex justify-center items-center bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1.5 rounded border border-yellow-500"><svg
                                class="w-3 h-3 mr-1 text-yellow-800" aria-hidden="true"
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
    </div>
</div>
