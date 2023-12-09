@extends('layouts.frame_nocarousel')


@section('content_page')

<div class="mx-auto max-w-screen-xl text-center sm:col-span-2 md:col-span-2 lg:col-span-4 mb-4 pt-16">
    <h1 class="mb-8 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        {!! $pageTitle !!}</h1>
    <p class="text-lg font-normal text-gray-900 lg:text-xl sm:px-16 lg:px-48">{!! $pageDescription !!}</p>
</div>
<div class = "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-12 pt-16 pb-16 mx-auto">
    @foreach ($products as $product)
        <div
            class="flex flex-col justify-center items-center w-full h-full bg-white border border-gray-900 rounded-lg dark:bg-gray-900 dark:border-gray-800 mx-auto shadow hover:shadow-xl transform transition duration-500 hover:-translate-y-4 hover:z-40">
            <img class="h-3/4 rounded-t-lg w-full object-cover" src="{{ $product->image }}"
                alt="{{ $product->image }}" />
            <div class="h-1/4 px-8 pb-2 flex flex-col justify-center items-center">
                <h5 class="sm:text-lg lg:text-2xl font-bold tracking-tight text-yellow-500 text-center">{{ $product->name }}
                </h5>
                <p class="fold:text-xs text-base font-normal text-white text-center">{{ $product->price }}</p>
                <p class="fold:text-xs text-base font-normal text-white text-center">{{ $product->stock }}</p>
                <p class="fold:text-xs text-base font-normal text-white text-center">{{ $product->weight }}gr</p>
            </div>
        </div>
    @endforeach
</div>

@endsection
