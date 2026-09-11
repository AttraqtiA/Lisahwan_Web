@extends('layouts.frame')

@section('meta_seo')
    <!-- SEO Standard -->
    <meta name="description"
        content="Selamat datang di toko online resmi Lisahwan! Pusat belanja terlengkap. Beli langsung aneka Spikoe autentik, lauk kering, dan oleh-oleh Surabaya kualitas terbaik.">
    <meta name="keywords"
        content="Lisahwan, spikoe surabaya, oleh-oleh surabaya, lauk kering surabaya, camilan khas surabaya, kue lapis surabaya">

    <!-- Open Graph (WhatsApp, Facebook, IG Preview) -->
    <meta property="og:title" content="Lisahwan - Oleh-oleh Surabaya">
    <meta property="og:description"
        content="Toko online resmi Lisahwan. Pusat belanja Spikoe autentik, lauk kering, dan oleh-oleh Surabaya terbaik. Pesan langsung di sini!">
    <meta property="og:image" content="{{ asset('images/lisahwan_logo.png') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">

    <!-- GEO / JSON-LD Schema Markup (Organization & WebSite) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "Organization",
          "name": "Lisahwan",
          "url": "{{ request()->url() }}",
          "logo": "{{ asset('images/lisahwan_logo.png') }}",
          "description": "Toko online resmi Lisahwan. Pusat belanja Spikoe autentik, lauk kering, dan oleh-oleh Surabaya."
        },
        {
          "@type": "WebSite",
          "name": "Lisahwan",
          "url": "{{ request()->url() }}"
        }
      ]
    }
    </script>
@endsection

@section('content_page')
    @include('layouts.hero')
    <section>
        <div class="gap-12 items-center py-8 px-8 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-16">
            <div class="font-light sm:text-lg text-gray-500">
                <h2 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                    class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Brand Story Lisahwan
                </h2>
                <!-- Paragraf utama (always visible) -->
                <p data-aos="fade-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800" class="mb-4">
                    Sejak 2007, Lisahwan tumbuh dari kecintaan pada rasa dan tradisi keluarga. Berawal dari Surabaya, kami
                    menghadirkan berbagai sajian yang terinspirasi dari kekayaan cita rasa Nusantara, mulai dari aneka
                    camilan dan lauk kering, hingga Spikoe resep keluarga yang telah menjadi <i>signature</i> Lisahwan. Nama
                    Lisahwan sendiri berasal dari perpaduan nama Lisa dan Hwan, sebuah nama yang terus membawa perjalanan
                    keluarga kami hingga hari ini.
                </p>
                <!-- Hidden content -->
                <div id="brandStoryMore" class="hidden">
                    <p data-aos="fade-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800" class="mb-4">
                        Kami senantiasa percaya bahwa rasa yang baik tidak perlu berlebihan. Ia cukup dibuat dengan bahan
                        yang berkualitas, proses pembuatan yang konsisten, dan perhatian penuh pada setiap detail. Karena
                        pada akhirnya, yang kami ingin hadirkan bukan sekadar makanan, tetapi <i>rasa yang ingin Anda bawa
                            pulang.</i>
                    </p>
                    <p data-aos="fade-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="mb-4 italic font-medium">
                        Lisahwan: Sajian Praktis, Cita Rasa Nusantara.
                    </p>
                </div>
                <!-- Toggle button -->
                <button id="toggleBrandStory"
                    class="mb-4 text-sm text-yellow-500 font-medium hover:underline focus:outline-none">
                    Lihat lebih lanjut
                </button>
            </div>
            <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="mt-6 lg:mt-0 relative w-full rounded-lg overflow-hidden shadow-xl">
                <div id="brand-story-carousel" class="relative w-full" data-carousel="slide" data-carousel-interval="2000">
                    <!-- Carousel wrapper -->
                    <div class="relative w-full aspect-square md:aspect-[4/5] lg:h-[550px] overflow-hidden rounded-lg">
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                            <img src="{{ isset($carousel_1) ? $carousel_1 : asset('images/fotoproduk/GalleryCarousel_10.jpg') }}"
                                class="absolute block w-full h-full object-cover object-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                                alt="Produk Lisahwan 1">
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ isset($carousel_2) ? $carousel_2 : asset('images/fotoproduk/GalleryCarousel_8.jpg') }}"
                                class="absolute block w-full h-full object-cover object-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                                alt="Produk Lisahwan 2">
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ isset($carousel_3) ? $carousel_3 : asset('images/fotoproduk/GalleryCarousel_13.jpeg') }}"
                                class="absolute block w-full h-full object-cover object-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                                alt="Produk Lisahwan 3">
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ isset($carousel_4) ? $carousel_4 : asset('images/fotoproduk/GalleryCarousel_14.jpg') }}"
                                class="absolute block w-full h-full object-cover object-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                                alt="Produk Lisahwan 4">
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ isset($carousel_5) ? $carousel_5 : asset('images/fotoproduk/GalleryCarousel_15.jpg') }}"
                                class="absolute block w-full h-full object-cover object-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                                alt="Produk Lisahwan 5">
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white focus:bg-white"
                            aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white focus:bg-white"
                            aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white focus:bg-white"
                            aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white focus:bg-white"
                            aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white focus:bg-white"
                            aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-black/30 group-hover:bg-black/50 group-focus:ring-4 group-focus:ring-yellow-500 group-focus:outline-none transition-all">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-black/30 group-hover:bg-black/50 group-focus:ring-4 group-focus:ring-yellow-500 group-focus:outline-none transition-all">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-900">
        <div class="py-8 px-8 mx-auto max-w-screen-xl lg:p-16">
            <div data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="max-w-screen-lg mb-10 w-full">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-white">Apa saja yang spesial dari Lisahwan?
                </h2>
                <p class="sm:text-xl text-gray-400">
                    Produk Lisahwan dirancang untuk dinikmati oleh seluruh keluarga, mulai dari anak-anak hingga orang
                    dewasa dan orang tua. Dengan rasa yang sesuai selera serta kualitas premium, Lisahwan menjadi pilihan
                    untuk menemani momen kebersamaan keluarga sekaligus sebagai oleh-oleh spesial bercita rasa Nusantara.
                </p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12 mb-12">
                <!-- TRUST -->
                <div data-aos="fade-up" data-aos-duration="800" class="flex flex-col items-center text-center">
                    <svg class="w-6 h-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M12 2L4 5v6c0 5.25 3.5 10.1 8 11.5 4.5-1.4 8-6.25 8-11.5V5l-8-3z" />
                    </svg>
                    <h3 class="mt-3 mb-2 text-xl font-bold text-yellow-500">Trust</h3>
                    <p class="text-gray-400">
                        Kepercayaan dibangun melalui konsistensi. Sejak 2007, Lisahwan menjaga kualitas rasa,
                        pemilihan bahan, dan proses produksi agar setiap produk selalu dapat diandalkan.
                    </p>
                </div>
                <!-- VALUE -->
                <div data-aos="fade-up" data-aos-duration="800" class="flex flex-col items-center text-center">
                    <svg class="w-6 h-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.657 3.172 10.828a4 4 0 010-5.656z" />
                    </svg>
                    <h3 class="mt-3 mb-2 text-xl font-bold text-yellow-500">Value</h3>
                    <p class="text-gray-400">
                        Setiap produk Lisahwan dibuat dari bahan pilihan dengan standar kualitas tinggi,
                        menghadirkan rasa khas Nusantara yang bernilai dan layak dibagikan.
                    </p>
                </div>
                <!-- EXPERIENCE -->
                <div data-aos="fade-up" data-aos-duration="800" class="flex flex-col items-center text-center">
                    <svg class="w-6 h-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.286 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.176 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.286-3.955a1 1 0 00-.364-1.118L2.012 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.955z" />
                    </svg>
                    <h3 class="mt-3 mb-2 text-xl font-bold text-yellow-500">Experience</h3>
                    <p class="text-gray-400">
                        Lisahwan menghadirkan pengalaman menyeluruh, mulai dari rasa yang konsisten,
                        tampilan produk yang menarik, hingga pelayanan yang ramah dan berkesan.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 max-w-4xl mx-auto">
                <!-- HALAL -->
                <div data-aos="fade-up" data-aos-duration="800" class="flex flex-col items-center text-center">
                    <svg class="w-7 h-7 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10
                                                                            10-4.477 10-10S17.523 2 12 2zm4.707 7.293a1 1 0 0 0-1.414 0L11 13.586
                                                                            8.707 11.293a1 1 0 1 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l5-5a1 1 0 0 0 0-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <h3 class="mt-3 mb-2 text-xl font-bold text-yellow-500">
                        Halal
                    </h3>
                    <p class="text-gray-400">
                        Seluruh produk Lisahwan diproses dengan standar yang ketat dan telah
                        bersertifikasi halal, sebagai komitmen menghadirkan produk yang aman
                        dan berkualitas.
                    </p>
                </div>
                <!-- FAST RESPONSE -->
                <div data-aos="fade-up" data-aos-duration="800" class="flex flex-col items-center text-center">
                    <svg class="w-7 h-7 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path d="M11.3 1L1 11h6l-1 8 10.3-10H10l1.3-8z" />
                    </svg>
                    <h3 class="mt-3 mb-2 text-xl font-bold text-yellow-500">
                        Fast Response
                    </h3>
                    <p class="text-gray-400">
                        Kami berkomitmen memberikan respon cepat dan solutif agar setiap
                        kebutuhan pelanggan ditangani dengan tepat waktu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="flex flex-col p-8 lg:p-16">
        <div class="flex flex-row justify-between items-center">
            <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="text-xl lg:text-3xl font-extrabold text-gray-900">Produk Bestseller</h1>
            <a data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                href="{{ route('products') }}">
                <p class="text-base font-medium text-yellow-500 hover:text-yellow-600">Lihat semua</p>
            </a>
        </div>
        <hr data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
            class="h-px my-2 border-0 bg-gray-400">
        <div
            class = "md:w-full lg:w-4/6 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-4 mx-auto @if (count($products_bestseller) == 0) h-full justify-center items-center @endif">
            @if (count($products_bestseller) > 0)
                @foreach ($products_bestseller as $bestseller)
                    <div
                        class="w-full relative hover:shadow-xl transform transition duration-500 hover:-translate-y-4 hover:z-40 mx-auto">
                        <a href="{{ route('member.products.show', $bestseller->product->id) }}">
                            <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="relative w-full h-full rounded-lg bg-gray-900 border-gray-800 mx-auto shadow-lg overflow-hidden flex flex-col">
                                @if (strlen($bestseller->product->image) > 30)
                                    <img class="w-full h-auto" src="{{ asset('storage/' . $bestseller->product->image) }}"
                                        alt="{{ $bestseller->product->image }}" />
                                @else
                                    <img class="w-full h-auto" src="/images/fotoproduk/{{ $bestseller->product->image }}"
                                        alt="{{ $bestseller->product->image }}" />
                                @endif
                                <div class="p-4 flex flex-col flex-grow">
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
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 10">
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
                                    {{-- @if ($bestseller->product->stock == 0)
                                        <p
                                            class="text-sm sm:text-base md:text-base lg:text-sm font-normal text-red-600 text-center mt-2">
                                            Stok Habis!</p>
                                    @else
                                        <p
                                            class="text-sm sm:text-base md:text-base lg:text-sm font-normal text-lime-500 text-center mt-2">
                                            Tersisa {{ $bestseller->product->stock }}
                                            stok
                                            lagi!</p>
                                    @endif --}}
                                    <div class="text-right">
                                        @auth
                                            <!-- SVG icon di kanan bawah dari gambar -->
                                            <form action="{{ route('member.wishlist.store', $bestseller->product->id) }}"
                                                method="POST" class="flex justify-end items-center">
                                                @csrf
                                                @if (
                                                    $bestseller->product->wishlist->where('user_id', Auth::user()->id)->first() &&
                                                        $bestseller->product->wishlist->where('user_id', Auth::user()->id)->first()->favorite_status == '1')
                                                    <button type="submit">
                                                        <svg class="cursor-pointer w-6 h-6 text-red-600 hover:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 20 18">
                                                            <path
                                                                d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                                                        </svg>
                                                    </button>
                                                @else
                                                    <button type="submit">
                                                        <svg class="cursor-pointer w-6 h-6 text-white hover:text-red-600"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 20 18">
                                                            <path
                                                                d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </form>
                                        @endauth
                                        @guest
                                            <button type="button"
                                                onclick="event.preventDefault(); window.location.href='{{ route('login') }}'">
                                                <svg class="cursor-pointer w-6 h-6 text-white hover:text-red-600"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 18">
                                                    <path
                                                        d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                                                </svg>
                                            </button>
                                        @endguest
                                    </div>
                                </div>
                        </a>
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
            <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="text-center text-lg font-bold text-gray-400">Mohon maaf, belum ada
                produk best seller!</h1>
        </div>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            let isExpanded = false;

            $('#toggleBrandStory').on('click', function() {
                if (!isExpanded) {
                    $('#brandStoryMore').slideDown(300);
                    $(this).text('Tutup');
                    isExpanded = true;
                } else {
                    $('#brandStoryMore').slideUp(300);
                    $(this).text('Lihat lebih lanjut');
                    isExpanded = false;
                }
            });
        });
    </script>
@endsection
