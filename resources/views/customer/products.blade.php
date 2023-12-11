@extends('layouts.frame_nocarousel')

@section('content_page')
    <div class="mx-auto max-w-screen-xl text-center sm:col-span-2 md:col-span-2 lg:col-span-4 mb-4 pt-16">
        <h1 class="mb-8 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            {!! $pageTitle !!}</h1>
        <p class="text-lg font-normal text-gray-900 lg:text-xl sm:px-16 lg:px-48">{!! $pageDescription !!}</p>
    </div>
    <div class = "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-12 pt-16 pb-16 mx-auto">
        @foreach ($products as $product)
            <div class="relative hover:shadow-xl transform transition duration-500 hover:-translate-y-4 hover:z-40">
                <a href="/products/{{ $product->id }}">
                    <div
                        class="relative w-full h-full bg-white border border-gray-900 rounded-lg dark:bg-gray-900 dark:border-gray-800 mx-auto shadow">
                        <img class="h-3/4 rounded-t-lg w-full object-cover" src="/images/fotoproduk/{{ $product->image }}"
                            alt="{{ $product->image }}" />
                        <div class="h-1/4 px-8 pb-2 flex flex-col justify-center items-center">
                            <h5 class="sm:text-xl font-bold tracking-tight text-yellow-500 text-center">
                                {{ $product->name }}
                            </h5>
                            <p class="text-base font-normal text-white text-center"> Rp.
                                {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-sm font-normal text-lime-500 text-center mt-2">Tersisa {{ $product->stock }}
                                stock
                                lagi</p>
                        </div>
                        <!-- SVG icon di kanan bawah dari gambar -->
                        <svg class="absolute w-6 h-6 text-gray-800 dark:text-white bottom-4 right-4 hover:text-red-600"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                        </svg>
                        <!-- Diskon di pojok kanan atas -->
                        @if ($product->discount == 0)
                            <div
                                class="absolute top-0 right-0 m-4 text-base text-red-600 rounded-lg font-bold bg-gray-900 p-3">
                                {{ $product->discount }}%</div>
                        @endif
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
