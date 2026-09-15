<section style="background-image: url('/images/fotoproduk/GalleryCarousel_8.jpg')"
    class="relative bg-cover bg-center bg-no-repeat bg-gray-700 bg-blend-multiply overflow-hidden h-[400px]">

    <div id="cta-carousel" class="relative w-full h-full" data-carousel="slide" data-carousel-interval="4000">
        <!-- Carousel wrapper -->
        <div class="relative h-full overflow-hidden">
            <!-- Slide 1: B2C Order -->
            <div class="hidden duration-700 ease-in-out h-full flex flex-col items-center justify-center"
                data-carousel-item="active">
                <div
                    class="px-6 mx-auto max-w-screen-xl text-center text-white h-full flex flex-col justify-center items-center">
                    <h2
                        class="text-center mb-8 sm:mb-10 text-2xl sm:text-3xl md:text-4xl font-bold drop-shadow-md leading-snug">
                        Tunggu apa lagi? <mark class="px-2 text-yellow-500 bg-gray-900 rounded">Order Sekarang</mark>
                        juga!
                    </h2>

                    @guest
                        <a href="{{ route('register') }}"
                            class="inline-flex justify-center items-center py-3 px-6 sm:py-4 sm:px-7 text-base sm:text-lg font-medium text-center text-white rounded-xl bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 transform transition hover:scale-105 shadow-lg">
                            Order Sekarang
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('products') }}"
                            class="inline-flex justify-center items-center py-3 px-6 sm:py-4 sm:px-7 text-base sm:text-lg font-medium text-center text-white rounded-xl bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 transform transition hover:scale-105 shadow-lg">
                            Lihat Produk
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 ms-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Slide 2: B2B Reseller -->
            <div class="hidden duration-700 ease-in-out h-full flex flex-col items-center justify-center"
                data-carousel-item>
                <div
                    class="px-6 mx-auto max-w-screen-xl text-center text-white h-full flex flex-col justify-center items-center">
                    <h2
                        class="text-center mb-4 sm:mb-6 text-2xl sm:text-3xl md:text-4xl font-bold drop-shadow-md leading-snug">
                        <mark class="px-2 text-yellow-500 bg-gray-900 rounded">Hadirkan
                            Lisahwan</mark> lebih dekat ke pelanggan Anda.
                    </h2>
                    <p
                        class="mb-8 sm:mb-10 text-base sm:text-lg md:text-xl text-gray-200 max-w-2xl mx-auto drop-shadow px-2">
                        Bawa kelezatan cita rasa Lisahwan ke kota Anda dan dapatkan penawaran khusus untuk kerja sama
                        berkelanjutan.
                    </p>

                    <a href="https://wa.me/6282230308030?text=Halo%20Lisahwan%2C%20saya%20tertarik%20untuk%20bergabung%20menjadi%20reseller."
                        target="_blank"
                        class="inline-flex justify-center items-center py-3 px-6 sm:py-4 sm:px-7 text-base sm:text-lg font-medium text-center text-white rounded-xl bg-[#25D366] hover:bg-[#128C7E] focus:ring-4 focus:ring-green-300 transform transition hover:scale-105 shadow-lg">
                        Hubungi WhatsApp
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007A9.959 9.959 0 0 1 2 12Z"
                                clip-rule="evenodd" />
                            <path
                                d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.114.085-.181.086-.22.153-.256.249-.413.075-.124.072-.25-.018-.39-.089-.138-.857-2.072-.949-2.365-.091-.286-.239-.24-.316-.24-.055 0-.173.013-.275.013-.153 0-.374.032-.562.247-.197.227-.723.708-.723 1.727 0 1.02.735 2.012.83 2.14.095.127 1.442 2.228 3.513 3.125.688.297 1.355.452 1.83.567.82.203 1.55.176 2.075.099.64-.093 1.497-.611 1.708-1.202.21-.59.21-1.096.148-1.202-.062-.107-.225-.17-.468-.29Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="true"
                aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false"
                aria-label="Slide 2" data-carousel-slide-to="1"></button>
        </div>

        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-black/30 group-hover:bg-black/50 group-focus:ring-4 group-focus:ring-yellow-500 group-focus:outline-none transition-all">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-black/30 group-hover:bg-black/50 group-focus:ring-4 group-focus:ring-yellow-500 group-focus:outline-none transition-all">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</section>
