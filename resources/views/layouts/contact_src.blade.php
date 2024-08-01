<section style="background-image: url('/images/fotoproduk/GalleryCarousel_8.jpg')"
    class="bg-cover bg-center bg-no-repeat bg-gray-700 bg-blend-multiply">
    <div class="px-4 mx-auto max-w-screen-xl text-center text-white py-16 lg:py-32">
        <h2 data-aos="fade-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
            class="text-center mb-20 text-4xl font-bold">Tunggu apa lagi? <mark
                class="px-2 text-yellow-500 bg-gray-900 rounded">Order Sekarang</mark> juga!</h2>

        @guest
            <a data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                href="{{ route('register') }}"
                class="inline-flex justify-center items-center py-4 px-7 text-lg font-medium text-center text-white rounded-xl bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300">
                Order Sekarang
                <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        @endguest

        @auth
            <a data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                href="{{ route('products') }}"
                class="inline-flex justify-center items-center py-4 px-7 text-lg font-medium text-center text-white rounded-xl bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300">
                Lihat Produk
                <svg class="w-5 h-5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        @endauth
    </div>
</section>
