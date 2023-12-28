@extends('layouts.frame')

@section('content_page')
    <section>
        <div class="gap-12 items-center py-8 px-8 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-16">
            <div class="font-light sm:text-lg text-gray-500">
                <h2 class="mb-3 text-4xl tracking-tight font-extrabold text-gray-900">Waktu Nyemil Jadi Hangat dan Renyah
                </h2>
                <p class="mb-4">Dengan komitmen kami akan kualitas, kami menyediakan rangkaian camilan yang diolah dengan
                    penuh dedikasi sehingga customer selalu mendapatkan cita rasa yang khas dari camilan Lisahwan.</p>
                <a href="{{ route('register') }}"
                    class="mr-1 cursor-pointer text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center">
                    Jadi Member
                    <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="/products"
                    class="cursor-pointer border font-medium rounded-lg text-base px-5 py-3 border-yellow-500 text-yellow-500 hover:text-white hover:bg-yellow-500">
                    Lihat Produk
                </a>
            </div>
            <div class="grid grid-cols-2 gap-x-2 sm:gap-x-4 mt-8 lg:mt-0">
                <img class="mb-2 sm:mb-4 lg:mb-0 w-full rounded-lg" src="/images/fotoproduk/GalleryCarousel_2.jpg"
                    alt="GalleryCarousel_2.jpg">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="/images/fotoproduk/GalleryCarousel_8.jpg"
                    alt="GalleryCarousel_2.jpg">
                <img class="mb-2 sm:mb-4 lg:mb-0 w-full rounded-lg" src="/images/fotoproduk/GalleryCarousel_11.jpg"
                    alt="GalleryCarousel_2.jpg">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="/images/fotoproduk/GalleryCarousel_5.jpg"
                    alt="GalleryCarousel_2.jpg">
            </div>
        </div>
    </section>

    <section class="bg-gray-900">
        <div class="py-8 px-8 mx-auto max-w-screen-xl lg:p-16">
            <div class="max-w-screen-lg mb-10 w-full">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-white">Apa saja yang spesial dari Lisahwan?</h2>
                <p class="sm:text-xl text-gray-400">
                    Dalam inspirasi kekayaan hasil laut dan keanekaragaman bumbu rempah Jawa Timur, kami memahami bahwa
                    dengan menggabungkan kedua elemen tersebut, kami mampu menciptakan cemilan berkualitas tinggi dan lezat
                    di Lisahwan.
                </p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12 justify-center items-center">
                <div class="flex flex-col justify-center items-center">
                    <div>
                        <svg class="w-6 h-6 text-yellow-500 text-center" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-center mb-2 text-xl font-bold text-yellow-500">Taste</h3>
                    <p class="text-center text-gray-400">Setiap gigitan menghadirkan cita rasa
                        istimewa yang sulit untuk dilupakan.</p>
                </div>

                <div class="flex flex-col justify-center items-center">
                    <div>
                        <svg class="w-6 h-6 text-yellow-500 text-center" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-center mb-2 text-xl font-bold text-yellow-500">Premium</h3>
                    <p class="text-center text-gray-400">Mulai dari kualitas produk, bahan, bumbu, hingga
                        packaging, semuanya memiliki
                        standar premium untuk pengalaman terbaik bagi customer kami.</p>
                </div>

                <div class="flex flex-col justify-center items-center">
                    <div>
                        <svg class="w-6 h-6 text-yellow-500 text-center" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-center mb-2 text-xl font-bold text-yellow-500">Homemade</h3>
                    <p class="text-center text-gray-400">Tiada yang dapat menyaingi cita rasa autentik, hangat, dan memikat
                        ala
                        homemade. </p>
                </div>

                <div
                    class="flex flex-col lg:flex-row justify-center items-center lg:col-span-3 lg:gap-x-6 gap-y-10 lg:gap-y-0">
                    <div class="flex flex-col justify-center items-center">
                        <div>
                            <svg class="w-6 h-6 text-yellow-500 text-center" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M7.824 5.937a1 1 0 0 0 .726-.312 2.042 2.042 0 0 1 2.835-.065 1 1 0 0 0 1.388-1.441 3.994 3.994 0 0 0-5.674.13 1 1 0 0 0 .725 1.688Z" />
                                <path
                                    d="M17 7A7 7 0 1 0 3 7a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V7a5 5 0 1 1 10 0v7.083A2.92 2.92 0 0 1 12.083 17H12a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a1.993 1.993 0 0 0 1.722-1h.361a4.92 4.92 0 0 0 4.824-4H17a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3Z" />
                            </svg>
                        </div>
                        <h3 class="mt-2 text-center mb-2 text-xl font-bold text-yellow-500">Fast Respond</h3>
                        <p class="text-center text-gray-400">Kami siap memberikan respon cepat untuk memastikan
                            kebutuhan dan pertanyaan
                            Anda terpenuhi dengan segera.</p>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <div>
                            <svg class="w-7 h-7 text-yellow-500 text-center" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="mt-2 text-center mb-2 text-xl font-bold text-yellow-500">Terlaris</h3>
                        <p class="text-center text-gray-400">Sejak 2007, Lisahwan telah menjadi brand camilan yang
                            terpercaya dan terlaris,
                            yang terus berinovasi dalam varian produk.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="flex flex-col p-8 lg:p-16">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-xl lg:text-3xl font-extrabold text-gray-900">Produk Best Seller</h1>
            <a href="{{ route('products') }}">
                <p class="text-sm lg:text-base font-medium text-yellow-500 hover:text-yellow-600">Lihat semua</p>
            </a>
        </div>
        <hr class="h-px my-2 border-0 bg-gray-400">
        <div
            class = "md:w-full lg:w-4/6 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 p-4 mx-auto @if (count($products_bestseller) == 0) h-full justify-center items-center @endif">
            @if (count($products_bestseller) > 0)
                @foreach ($products_bestseller as $bestseller)
                    <div
                        class="w-full relative hover:shadow-xl transform transition duration-500 hover:-translate-y-4 hover:z-40 mx-auto">
                        <a href="{{ route('member.products.show', $bestseller->product->id) }}">
                            <div class="relative w-full h-full rounded-lg bg-gray-900 border-gray-800 mx-auto shadow">
                                <img class="h-3/4 rounded-t-lg w-full object-center object-cover"
                                    src="/images/fotoproduk/{{ $bestseller->product->image }}"
                                    alt="{{ $bestseller->product->name }}" />
                                <div class="h-1/4 px-8 pb-2 flex flex-col justify-center items-center">
                                    <h5
                                        class="sm:leading-6 md:leading-normal lg:leading-normal text-xl sm:text-3xl md:text-2xl lg:text-xl font-bold tracking-tight text-yellow-500 text-center">
                                        {{ $bestseller->product->name }}
                                    </h5>
                                    <div class="flex flex-row w-full justify-center items-center">
                                        @if ($bestseller->product->discount != 0)
                                            <p
                                                class="text-base sm:text-sm md:text-lg lg:text-sm font-normal text-white text-center">
                                                Rp.
                                                {{ number_format($bestseller->product->price, 0, ',', '.') }}</p>
                                            <p
                                                class="ml-2 flex items-center text-base sm:text-sm md:text-lg lg:text-sm font-bold text-red-600 text-center">
                                                <svg class="w-4 h-4 mr-2 text-red-600" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>
                                                (Rp.
                                                {{ number_format($bestseller->product->countDiscount(), 0, ',', '.') }})
                                            </p>
                                        @else
                                            <p
                                                class="text-base sm:text-sm md:text-lg lg:text-base font-normal text-white text-center">
                                                Rp.
                                                {{ number_format($bestseller->product->price, 0, ',', '.') }}</p>
                                        @endif
                                    </div>
                                    @if ($bestseller->product->stock == 0)
                                        <p
                                            class="text-sm sm:text-base md:text-base lg:text-sm font-normal text-red-600 text-center mt-2">
                                            Stock Habis!</p>
                                    @else
                                        <p
                                            class="text-sm sm:text-base md:text-base lg:text-sm font-normal text-lime-500 text-center mt-2">
                                            Tersisa {{ $bestseller->product->stock }}
                                            stock
                                            lagi!</p>
                                    @endif
                                </div>
                        </a>

                        <!-- SVG icon di kanan bawah dari gambar -->
                        <form action="{{ route('member.wishlist.store', $bestseller->product->id) }}" method="POST">
                            @csrf
                            @if ($bestseller->product->favorite_status == 0)
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
                        @if ($bestseller->product->discount != 0)
                            <div
                                class="absolute top-0 right-0 m-4 text-lg text-red-600 rounded-lg font-bold bg-gray-900 p-2">
                                {{ $bestseller->product->discount }}%</div>
                        @endif
                    </div>
        </div>
        @endforeach
    @else
        <div class="col-span-2 flex flex-col items-center justify-center">
            <h1 class="text-center text-lg font-bold text-gray-400">Mohon maaf, belum ada
                produk best seller!</h1>
        </div>
        @endif
    </div>
@endsection
