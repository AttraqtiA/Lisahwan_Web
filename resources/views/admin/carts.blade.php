@extends('layouts.admin.frame_admin')

@section('content_page')
    <div class="flex flex-col items-center sm:ml-56 sm:mt-20">
        <div class="mx-auto w-11/12 sm:max-w-screen-xl text-center sm:col-span-2 md:col-span-2 lg:col-span-4 mt-36 sm:mt-16">
            <h1 class="mb-8 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
                {!! $pageTitle !!}</h1>
            <p class="text-lg font-normal text-gray-900 lg:text-xl sm:px-16 lg:px-48">{!! $pageDescription !!}</p>
        </div>
        <div class = "flex flex-col  @if (empty($carts)) w-full justify-center items-center @endif">
            @php
                $countSubtotal = 0;
            @endphp
            @if (!empty($carts))
                @foreach ($carts as $cart)
                    <div class="flex flex-row items-center w-full">
                        @if (strlen($cart->product->image) > 30)
                            <img class="h-40 w-44 object-cover object-bottom rounded-lg drop-shadow-md"
                                src="{{ asset('storage/' . $cart->product->image) }}" alt="{{ $cart->product->image }}" />
                        @else
                            <img class="h-40 w-44 object-cover object-bottom rounded-lg drop-shadow-md"
                                src="/images/fotoproduk/{{ $cart->product->image }}" alt="{{ $cart->product->name }}">
                        @endif
                        <div class="flex flex-col ml-4 justify-center w-full space-y-8">
                            <div>
                                <p class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ $cart->product->name }}</p>
                                <p class="text-xs sm:text-sm font-normal text-gray-400">
                                    {{ $cart->quantity }} buah
                                    ({{ $cart->weight }} gram)
                                </p>
                                <p class="text-sm sm:text-base font-medium text-gray-900">Rp.
                                    {{ number_format($cart->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div>
                                <div class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between">
                                    <form action="{{ route('member.carts.edit', $cart->product_id) }}" method="GET">
                                        @csrf
                                        <button type="submit"
                                            class="cursor-pointer text-gray-900 bg-yellow-500 hover:bg-yellow-600 font-medium rounded-md text-xs sm:text-sm px-2 py-1 inline-flex items-center">
                                            <svg class="w-4 h-4 sm:mr-1 text-gray-900" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                <path
                                                    d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                <path
                                                    d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                            </svg>
                                            <span class="sm:inline-block">Ubah Pesanan</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('member.carts.destroy', $cart->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            class="cursor-pointer text-xs sm:text-sm font-medium text-yellow-500 hover:text-yellow-600"
                                            onclick="return confirm('Apakah anda ingin menghapus pesanan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $countSubtotal += $cart->price;
                    @endphp
                    @if (!$loop->last)
                        <hr class="h-px my-4 border-0 bg-gray-400">
                    @else
                    @endif
                @endforeach
            @else
                <div class="flex flex-col items-center justify-center mt-64">
                    <h1 class="text-center text-xl font-bold text-gray-400">Keranjang
                        anda kosong</h1>
                    <a href="{{ route('admin.products') }}">
                        <p class="text-center text-base font-normal text-yellow-500">Belanja sekarang!</p>
                    </a>
                </div>
            @endif
            @if ($countSubtotal)
                <hr class="h-px my-7 border-2 border-yellow-500">
                <div class="flex flex-row justify-between items-center">
                    <p class="text-lg font-medium text-gray-900">
                        Subtotal:
                    </p>
                    <p class="text-lg font-medium text-gray-900">
                        Rp. {{ number_format($countSubtotal, 0, ',', '.') }}
                    </p>
                </div>
                <p class="text-sm font-normal text-gray-400">
                    Ongkos kirim ditambahkan ketika checkout.
                </p>
                <form action="{{ route('member.checkout') }}" method="GET">
                    <button type="submit"
                        class="cursor-pointer mt-7 w-full text-gray-900 bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-base px-5 py-2.5 text-center items-center">
                        Checkout
                    </button>
                </form>
                <a href="/products" class="mt-3 flex flex-row justify-center items-center w-full">
                    <p class="text-sm font-normal text-gray-400">
                        atau <span class="text-yellow-500">Lanjut Belanja</span>
                    </p>
                    <svg class="ml-1 w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            @endif
        </div>
    </div>
@endsection
