@extends('layouts.frame_nocarousel')

@section('content_page')
    <div class="flex flex-row p-12">
        <div class="flex flex-col ">
            <img class="h-auto max-w-lg rounded-lg" src="/images/fotoproduk/{{ $product->image }}" alt="{{ $product->image }}">
        </div>
        <div class="flex flex-col ml-7">
            <h2 class="text-4xl font-extrabold dark:text-white">{{ $product->name }}</h2>
            <p class="my-4 text-lg text-gray-500">{{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="my-4 text-lg text-gray-500">Ketersediaan stok: {{ $product->stock }} stok</p>
            <p class="my-4 text-lg text-gray-500">{{ $product->description }}</p>
            <button type="button" class="text-yellow-500 hover:text-white border border-yellow-500 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-500 dark:focus:ring-yellow-500">Yellow</button>
        </div>

    </div>
@endsection
