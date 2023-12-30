@extends('layouts.frame_auth')

@section('content_page')
    <div class="flex flex-col items-center">
        @if (session('deleteCart_success'))
            <div class="w-8/12 sm:w-5/12 md:w-4/12 lg:w-3/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('deleteCart_success') }}
                </div>
            </div>
        @endif
        @if (session('empty_stock'))
            <div class="w-8/12 sm:w-5/12 md:w-4/12 lg:w-3/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-red-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('empty_stock') }}
                </div>
            </div>
        @endif
        @if (session('empty_order'))
            <div class="w-10/12 sm:w-7/12 md:w-6/12 lg:w-4/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-red-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('empty_order') }}
                </div>
            </div>
        @endif
        @if (session('checkout_cancel'))
            <div class="w-10/12 sm:w-7/12 md:w-6/12 lg:w-4/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-red-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('checkout_cancel') }}
                </div>
            </div>
        @endif
        @if (session('addCart_success'))
            <div class="w-11/12 sm:w-8/12 md:w-6/12 lg:w-4/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{!! session('addCart_success') !!}
                </div>
            </div>
        @endif
        @if (session('updateCart_success'))
            <div class="w-8/12 sm:w-5/12 md:w-4/12 lg:w-3/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('updateCart_success') }}
                </div>
            </div>
        @endif
        @if (session('order_success'))
            <div class="w-8/12 sm:w-6/12 md:w-5/12 lg:w-4/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{!! session('order_success') !!}
                </div>
            </div>
        @endif
        @if (session('deleteWishlist_success'))
            <div class="w-10/12 sm:w-7/12 md:w-6/12 lg:w-4/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{!! session('deleteWishlist_success') !!}
                </div>
            </div>
        @endif
        <div class="mx-auto w-11/12 sm:max-w-screen-xl text-center sm:col-span-2 md:col-span-2 lg:col-span-4 mt-16">
            <h1 class="mb-8 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
                {!! $pageTitle !!}</h1>
            <p class="text-lg font-normal text-gray-900 lg:text-xl sm:px-16 lg:px-48">{!! $pageDescription !!}</p>
        </div>
        <div class = "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-12 py-12 mx-auto">
            @foreach ($products as $product)
                <div class="relative hover:shadow-xl transform transition duration-500 hover:-translate-y-4 hover:z-40">
                    @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isOwner()))
                        <a href="{{ route('products') }}">
                        @else
                            <a href="{{ route('member.products.show', $product->id) }}">
                    @endif
                    <div class="relative w-full h-full rounded-lg bg-gray-900 border-gray-800 mx-auto shadow">
                        <img class="h-3/4 rounded-t-lg w-full object-cover" src="/images/fotoproduk/{{ $product->image }}"
                            alt="{{ $product->image }}" />
                        <div class="h-1/4 px-8 pb-2 flex flex-col justify-center items-center">
                            <h5
                                class="sm:leading-6 md:leading-normal lg:leading-normal text-xl sm:text-2xl md:text-2xl lg:text-xl font-bold tracking-tight text-yellow-500 text-center">
                                {{ $product->name }}
                            </h5>
                            <div class="flex flex-row w-full justify-center items-center">
                                @if ($product->discount != 0)
                                    <p
                                        class="text-base sm:text-sm md:text-lg lg:text-sm font-normal text-white text-center">
                                        Rp.
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p
                                        class="ml-2 flex items-center text-base sm:text-sm md:text-lg lg:text-sm font-bold text-red-600 text-center">
                                        <svg class="w-4 h-4 mr-2 text-red-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg>
                                        (Rp. {{ number_format($product->countDiscount(), 0, ',', '.') }})
                                    </p>
                                @else
                                    <p
                                        class="text-base sm:text-sm md:text-lg lg:text-base font-normal text-white text-center">
                                        Rp.
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                @endif
                            </div>
                            @if ($product->stock == 0)
                                <p
                                    class="text-sm sm:text-base md:text-base lg:text-sm font-normal text-red-600 text-center mt-2">
                                    Stock Habis!</p>
                            @else
                                <p
                                    class="text-sm sm:text-base md:text-base lg:text-sm font-normal text-lime-500 text-center mt-2">
                                    Tersisa {{ $product->stock }}
                                    stock
                                    lagi!</p>
                            @endif
                        </div>
                        </a>

                        <!-- SVG icon di kanan bawah dari gambar -->
                        <form action="{{ route('member.wishlist.store', $product->id) }}" method="POST">
                            @csrf
                            @if ($product->favorite_status == 0)
                                <button type="submit">
                                    <svg class="cursor-pointer absolute w-6 h-6 text-white bottom-4 right-4 hover:text-red-600"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 18">
                                        <path
                                            d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                                    </svg>
                                </button>
                            @else
                                <button type="submit">
                                    <svg class="cursor-pointer absolute w-6 h-6 text-red-600 bottom-4 right-4 hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 18">
                                        <path
                                            d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                                    </svg>
                                </button>
                            @endif
                        </form>

                        <!-- Diskon di pojok kanan atas -->
                        @if ($product->discount != 0)
                            <div
                                class="absolute top-0 right-0 m-4 text-lg text-red-600 rounded-lg font-bold bg-gray-900 p-2">
                                {{ $product->discount }}%</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @guest
            @include('layouts.contact_src')
        @endguest
    </div>
@endsection
