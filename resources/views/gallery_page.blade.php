@extends('layouts.frame_nocarousel')

@section('content_page')
    <div class="mx-auto w-11/12 sm:max-w-screen-xl text-center sm:col-span-2 md:col-span-2 lg:col-span-4 mt-16">
        <h1 class="mb-8 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            {!! $pageTitle !!}</h1>
        <p class="text-lg font-normal text-gray-900 lg:text-xl sm:px-16 lg:px-48">{!! $pageDescription !!}</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 pt-16 px-12 pb-16 mx-auto">

        @foreach ($galleries as $gallery)
            <div class="relative group @if ($loop->index % 4 == 0) sm:col-span-2 lg:max-h-screen lg:col-span-3 @endif">
                @if ($gallery->type == 'image')
                    <img class="h-full w-full rounded-lg object-cover" src="/images/fotoproduk/{{ $gallery->content }}"
                        alt="{{ $gallery->content }}">
                    <div
                        class="rounded-lg absolute inset-0 flex items-center justify-center bg-black duration-500 bg-opacity-50 opacity-0 transition-opacity group-hover:opacity-100">
                        <div class="text-white text-center px-4">
                            <p class="text-lg md:text-2xl lg:text-3xl font-bold">{{ $gallery->title }}</p>
                        </div>
                    </div>
                @else
                    <video class="h-full w-full rounded-lg object-cover" controls>
                        <source src="/images/fotoproduk/{{ $gallery->content }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        @endforeach
    </div>
@endsection
